<?php

namespace Automile\Sdk\Tests\Integration\HttpClient;


use Automile\Sdk\Config;
use Automile\Sdk\HttpClient\Client\Curl;
use Automile\Sdk\HttpClient\Request\HttpRequest;
use Automile\Sdk\HttpClient\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

/**
 * Test Cases for the HttpClient\Curl class
 */
class CurlTest extends TestCase
{

    const TEST_URI = '/example/path';

    /**
     * instantiate a Curl client
     * @return Curl
     */
    private function _getClient()
    {
        $curl =  new Curl();
        $curl->setAdapter(new CurlAdapterMock());

        return $curl;
    }

    public function testGetRequest()
    {
        $curl = $this->_getClient();
        $adapter = $curl->getAdapter();

        $response = Config::getNewResponse();

        $headers = [
            'header2' => 'value2',
            'header3' => 'value3'
        ];
        $headersStr = [];
        foreach ($headers as $header => $value) {
            $headersStr[] = "{$header}: {$value}";
        }

        $params = [
            'param1' => 'value1',
            'param2' => 'value2'
        ];

        $responseHeaders = [
            'Content-Type' => 'application/json',
            'Content-Encoding' => 'gzip'
        ];

        $responseHeadersStr = [];
        foreach ($responseHeaders as $key => $value) {
            $responseHeadersStr[] = $key . ': ' . $value;
        }

        $responseHeadersLines = 'HTTP/1.1 200 OK'
            . JsonResponse::LINE_SEPARATOR
            . implode(JsonResponse::LINE_SEPARATOR, $responseHeadersStr)
            . JsonResponse::LINE_SEPARATOR
            . JsonResponse::LINE_SEPARATOR;

        $responseBody = $this->_generateBody();

        $request = (new HttpRequest())
            ->setUri(self::TEST_URI)
            ->setMethod(Config::METHOD_GET)
            ->setUriParam('param1', $params['param1'])
            ->setUriParams(['param2' => $params['param2']])
            ->setHeaders($headers);

        $response = new JsonResponse();
        $adapter->setMockResponse($responseHeadersLines . $responseBody);
        $adapter->setMockInfo([
            CURLINFO_HTTP_CODE => 200,
            CURLINFO_HEADER_SIZE => strlen($responseHeadersLines)
        ]);

        $isSuccessful = $curl->send($request, $response);

        $uri = Config::URL . self::TEST_URI . '?' . http_build_query($params);
        $this->assertEquals($uri, $adapter->getUrl());

        $curlOptions = [
            CURLOPT_HTTPGET => 1,
            CURLOPT_HTTPHEADER => $headersStr
        ];
        $this->assertArraySubset($curlOptions, $adapter->getOptions());

        $this->assertTrue($isSuccessful);
        $this->assertEquals($responseHeaders, $response->getHeaders());
        $this->assertEquals($responseBody, $response->getBody(true));
    }

    /**
     * @depends testGetRequest
     */
    public function testPostLocationRequest()
    {
        $curl = $this->_getClient();
        $adapter = $curl->getAdapter();

        $response = Config::getNewResponse();

        $responseHeaders = [
            'Content-Type' => 'application/json',
            'Content-Encoding' => 'gzip',
            'Location' => 'https://api.automile.com/location/testing'
        ];

        $responseHeadersStr = [];
        foreach ($responseHeaders as $key => $value) {
            $responseHeadersStr[] = $key . ': ' . $value;
        }

        $responseHeadersLines = 'HTTP/1.1 201'
            . JsonResponse::LINE_SEPARATOR
            . implode(JsonResponse::LINE_SEPARATOR, $responseHeadersStr)
            . JsonResponse::LINE_SEPARATOR
            . JsonResponse::LINE_SEPARATOR;

        $responseBody = $this->_generateBody();

        $request = (new HttpRequest())
            ->setUri(self::TEST_URI)
            ->setMethod(Config::METHOD_POST);

        $response = new JsonResponse();
        $adapter->setMockResponse($responseHeadersLines . $responseBody);
        $adapter->setMockInfo([
            CURLINFO_HTTP_CODE => 201,
            CURLINFO_HEADER_SIZE => strlen($responseHeadersLines)
        ]);

        $isSuccessful = $curl->send($request, $response);

        $this->assertTrue($isSuccessful);
        $this->assertEquals($responseBody, $response->getBody(true));
        $this->assertEquals($responseHeaders['Location'], $adapter->getUrl());
    }

    /**
     * generate mock body
     * @return string
     */
    private function _generateBody()
    {
        return implode("\n", array_fill(0, 10, sha1(rand(1, 9999))));
    }

}
