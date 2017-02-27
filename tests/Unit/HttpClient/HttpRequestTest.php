<?php

namespace Automile\Sdk\Tests\Unit\HttpClient;

use Automile\Sdk\HttpClient\Request\HttpRequest;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test Cases for HttpRequest class
 */
class HttpRequestTest extends TestCase
{

    /**
     * @return HttpRequest
     */
    public function testInit()
    {
        $request = new HttpRequest();
        $this->assertInstanceOf(RequestInterface::class, $request);

        return $request;
    }

    /**
     * @param HttpRequest $request
     * @depends testInit
     * @return HttpRequest
     */
    public function testHeaders(HttpRequest $request)
    {
        $headers = [
            'header2' => 'value2',
            'User-Agent' => 'Automile SDK Test Suite',
            'Content-Type' => 'application/xml'
        ];
        $this->assertInstanceOf(HttpRequest::class, $request->setUserAgent($headers['User-Agent']));
        $this->assertInstanceOf(HttpRequest::class, $request->setContentType($headers['Content-Type']));

        $this->assertInstanceOf(HttpRequest::class, $request->setHeaders(['header2' => $headers['header2']]));

        $this->assertInstanceOf(HttpRequest::class, $request->setHeader('header1', 'value1'));
        $this->assertEquals($request->getHeader('header1'), 'value1');
        $this->assertInstanceOf(HttpRequest::class, $request->unsetHeader('header1'));
        $this->assertNull($request->getHeader('header1'));

        $this->assertEquals($headers, $request->getHeaders());

        return $request;
    }

    /**
     * @param HttpRequest $request
     * @depends testHeaders
     */
    public function testHttpAuth(HttpRequest $request)
    {
        $username = 'testsuite-user';
        $password = 'testsuite-password';
        $header = 'Basic ' . base64_encode($username . ':' . $password);
        $this->assertInstanceOf(HttpRequest::class, $request->setHttpAuth($username, $password));
        $this->assertEquals($request->getHeader('Authorization'), $header);
        $this->assertInstanceOf(HttpRequest::class, $request->unsetAuth());
        $this->assertNull($request->getHeader('Authorization'));
    }

    /**
     * @param HttpRequest $request
     * @depends testHeaders
     */
    public function testBearerAuth(HttpRequest $request)
    {
        $token = sha1(rand(1, 9999));
        $header = 'Bearer ' . $token;
        $this->assertInstanceOf(HttpRequest::class, $request->setBearerAuth($token));
        $this->assertEquals($request->getHeader('Authorization'), $header);
        $this->assertInstanceOf(HttpRequest::class, $request->unsetAuth());
        $this->assertNull($request->getHeader('Authorization'));
    }

    /**
     * @param HttpRequest $request
     * @depends testInit
     */
    public function testUri(HttpRequest $request)
    {
        $uri = 'automile/test/suit';
        $params = [
            'param1' => 'value1',
            'param2' => 'value2'
        ];

        $this->assertInstanceOf(HttpRequest::class, $request->setUri($uri));
        $this->assertInstanceOf(HttpRequest::class, $request->setUriParam('param1', $params['param1']));
        $this->assertInstanceOf(HttpRequest::class, $request->setUriParams(['param2' => $params['param2']]));

        $this->assertEquals($uri, $request->getUri());
        $this->assertEquals($params, $request->getUriParams());
    }

    /**
     * @param HttpRequest $request
     * @depends testInit
     */
    public function testBody(HttpRequest $request)
    {
        $post = [
            'post1' => 'val1',
            'post2' => 'val2',
            'post_arr' => ['subkey1' => 'subval1', 'subkey2' => 'subval2']
        ];
        $jsonBody = json_encode([
            'json1' => 'val1',
            'json2' => 'val2',
            'json3' => ['subkey1' => 'subval1', 'subkey2' => 'subval2']
        ]);

        $this->assertInstanceOf(HttpRequest::class, $request->setPostParam('post1', $post['post1']));
        $this->assertEquals($post['post1'], $request->getPostParam('post1'));

        $this->assertInstanceOf(HttpRequest::class, $request->setPostParams([
            'post2' => $post['post2'],
            'post_arr' => $post['post_arr']
        ]));
        $this->assertEquals($post, $request->getPostParams());

        $this->assertEquals(http_build_query($post), $request->getBody());

        $this->assertInstanceOf(HttpRequest::class, $request->setBody($jsonBody));
        $this->assertEquals($jsonBody, $request->getBody());
    }

}
