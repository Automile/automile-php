<?php

namespace Automile\Sdk\Tests\Unit\HttpClient;


use Automile\Sdk\HttpClient\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

/**
 * Test Cases for JsonResponse class
 * @package Automile\Sdk\Tests\Unit\HttpClient
 */
class JsonResponseTest extends TestCase
{

    /**
     * @return JsonResponse
     */
    public function testInit()
    {
        $response = new JsonResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);

        return $response;
    }

    /**
     * @param JsonResponse $response
     * @depends testInit
     */
    public function testHeaders(JsonResponse $response)
    {
        $headers = [
            'Content-Type' => 'application/xml',
            'X-Powered-By' => 'Automile SDK Test Suite',
            'Header1' => 'Value1'
        ];

        $headersRaw = ['Status Line' => '200'];
        foreach ($headers as $header => $value) {
            $headersRaw[] = "{$header}: {$value}";
        }
        $headersRaw = implode(JsonResponse::LINE_SEPARATOR, $headersRaw);

        $this->assertInstanceOf(JsonResponse::class, $response->setHeaders($headersRaw));
        $this->assertEquals($headers['Content-Type'], $response->getHeader('Content-Type'));
        $this->assertEquals($headers, $response->getHeaders());
    }

    /**
     * @param JsonResponse $response
     * @depends testInit
     * @return JsonResponse
     */
    public function testStatus(JsonResponse $response)
    {
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCompleted());
        $this->assertNull($response->getRedirect());

        $body = [
            'key1' => 'val1',
            'key2' => ['val2', 'val3', 'val4']
        ];
        $bodyJson = json_encode($body);

        $this->assertInstanceOf(JsonResponse::class, $response->setStatusCode(JsonResponse::SUCCESS_CODE));
        $this->assertInstanceOf(JsonResponse::class, $response->setBody($bodyJson));
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isCompleted());
        $this->assertNull($response->getRedirect());
        $this->assertEquals((object)$body, $response->getBody());
        $this->assertEquals($bodyJson, $response->getBody(true));

        return $response;
    }

    /**
     * @param JsonResponse $response
     * @depends testStatus
     */
    public function testError(JsonResponse $response)
    {
        $body = [
            'Message' => 'Test Message'
        ];

        $this->assertInstanceOf(JsonResponse::class, $response->setStatusCode(JsonResponse::INTERNAL_ERROR_CODE));
        $this->assertInstanceOf(JsonResponse::class, $response->setBody(json_encode($body)));
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isCompleted());
        $this->assertNull($response->getRedirect());
        $this->assertEquals($body['Message'], $response->getErrorMessage());
    }

    /**
     * @param JsonResponse $response
     * @depends testStatus
     */
    public function testRedirect(JsonResponse $response)
    {
        $locationUri = 'http://google.com';
        $headers = 'Status Line'
            . JsonResponse::LINE_SEPARATOR
            . 'Location: ' . $locationUri;

        $this->assertInstanceOf(JsonResponse::class, $response->setStatusCode(JsonResponse::CREATED_CODE));
        $this->assertInstanceOf(JsonResponse::class, $response->setHeaders($headers));

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isCompleted());
        $this->assertEquals($locationUri, $response->getRedirect());
    }

}