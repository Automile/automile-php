<?php

namespace Automile\Sdk\HttpClient;

use Automile\Sdk\Config;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\ResponseInterface;

/**
 * Default Automile SDK HTTP client
 * @package Automile\Sdk\HttpClient
 */
class Curl implements ClientInterface
{

    /**
     * @var RequestInterface
     */
    private $_request;

    /**
     * @var ResponseInterface
     */
    private $_response;

    /**
     * cURL resource handler
     * @var resource
     */
    private $_curl;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function send(RequestInterface $request, ResponseInterface $response)
    {
        $this->_request = $request;
        $request->setUserAgent(Config::USER_AGENT);

        $this->_curl = $this->_initCurl();

        $this->_response = $this->_sendQuery($response);

        return $response->isSuccessful();
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @return resource
     * @throws HttpClientException
     */
    private function _initCurl()
    {
        $request = $this->_request;

        $curl = curl_init($this->_getUrl());

        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $request->getHeaders());

        switch ($request->getMethod()) {
            case Config::METHOD_GET:
                // do nothing
                break;
            case Config::METHOD_POST:
                curl_setopt($curl, CURLOPT_POST, 1);
                break;
            case Config::METHOD_PUT:
                // break intentionally omitted
            case Config::METHOD_DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($request->getMethod()));
                break;
            default:
                throw new HttpClientException("HTTP method '{$request->getMethod()}' is not supported");
        }

        if ($request->getPostParams()) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($request->getPostParams()));
        }

        return $curl;
    }

    /**
     * compose the complete URL of the query
     * @return string
     */
    private function _getUrl()
    {
        $request = $this->_request;

        $uri = ('/' == substr($request->getUri(), 0, 1) ? '' : '/')
            . $request->getUri();
        if ($request->getUriParams()) {
            $uri .= (false === strpos($uri, '?') ? '?' : '&')
                . http_build_query($request->getUriParams());
        }

        return Config::URL . $uri;
    }

    /**
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    private function _sendQuery(ResponseInterface $response)
    {
        $curl = $this->_curl;

        $content = curl_exec($curl);

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $response->setHeaders(substr($content, 0, $headerSize))
            ->setBody(substr($content, $headerSize))
            ->setStatusCode(curl_getinfo($curl, CURLINFO_HTTP_CODE));

        return $response;
    }

}