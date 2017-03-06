<?php

namespace Automile\Sdk\HttpClient\Client;

use Automile\Sdk\Config;
use Automile\Sdk\HttpClient\HttpClientException;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\ResponseInterface;

/**
 * Default Automile SDK HTTP client
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
     * @var CurlAdapter
     */
    private $_curlAdapter;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function send(RequestInterface $request, ResponseInterface $response)
    {
        $this->_request = $request;
        $request->setUserAgent(Config::USER_AGENT);

        if (Config::METHOD_POST == $request->getMethod() && !$request->getContentType()) {
            $request->setContentType('multipart/form-data');
        }

        $this->_curl = $this->_initCurl();

        $this->_response = $this->_sendQuery($response);

        $redirect = $this->_response->getRedirect();
        if ($redirect) {
            $request->setUri($redirect)
                ->setMethod(Config::METHOD_GET)
                ->setBody('');
            $this->_curl = $this->_initCurl();
            $this->_response = $this->_sendQuery($this->_response);
        }

        return $this->_response->isSuccessful();
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

        $curl = $this->getAdapter()->curlInit($this->_getUrl());

        $this->getAdapter()->curlSetopt($curl, CURLOPT_HEADER, 1);
        $this->getAdapter()->curlSetopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $this->getAdapter()->curlSetopt($curl, CURLOPT_ENCODING, "gzip");

        $headers = [];
        foreach ($request->getHeaders() as $header => $value) {
            $headers[] = "{$header}: {$value}";
        }
        $this->getAdapter()->curlSetopt($curl, CURLOPT_HTTPHEADER, $headers);

        $this->getAdapter()->curlSetopt($curl, CURLOPT_POSTFIELDS, $request->getBody() ?: '');

        switch ($request->getMethod()) {
            case Config::METHOD_GET:
                $this->getAdapter()->curlSetopt($curl, CURLOPT_HTTPGET, 1);
                break;
            case Config::METHOD_POST:
                $this->getAdapter()->curlSetopt($curl, CURLOPT_POST, 1);
                break;
            case Config::METHOD_PUT:
                // break intentionally omitted
            case Config::METHOD_DELETE:
                $this->getAdapter()->curlSetopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($request->getMethod()));
                break;
            default:
                throw new HttpClientException("HTTP method '{$request->getMethod()}' is not supported");
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

        $content = $this->getAdapter()->curlExec($curl);

        $headerSize = $this->getAdapter()->curlGetInfo($curl, CURLINFO_HEADER_SIZE);
        $response->setHeaders(substr($content, 0, $headerSize))
            ->setBody(substr($content, $headerSize))
            ->setStatusCode($this->getAdapter()->curlGetInfo($curl, CURLINFO_HTTP_CODE));

        return $response;
    }

    /**
     * Replace the default CurlAdapter with a custom one if needed
     * @param CurlAdapter $adapter
     */
    public function setAdapter(CurlAdapter $adapter)
    {
        $this->_curlAdapter = $adapter;
    }

    /**
     * @return CurlAdapter
     */
    public function getAdapter()
    {
        if (null === $this->_curlAdapter) {
            $this->_curlAdapter = new CurlAdapter();
        }

        return $this->_curlAdapter;
    }

}
