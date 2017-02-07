<?php

namespace Automile\Sdk\HttpClient\Request;

/**
 * Interface RequestInterface
 * @package Automile\Sdk\HttpClient
 */
interface RequestInterface
{

    /**
     * @param string $uri
     * @return RequestInterface
     */
    public function setUri($uri);

    /**
     * @return string
     */
    public function getUri();

    /**
     * @param string $header
     * @param string $value
     * @return RequestInterface
     */
    public function setHeader($header, $value);

    /**
     * @param array $headers
     * @return RequestInterface
     */
    public function setHeaders(array $headers);

    /**
     * @param string $header
     * @return string
     */
    public function getHeader($header);

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param string $userAgent
     * @return RequestInterface
     */
    public function setUserAgent($userAgent);

    /**
     * @return string
     */
    public function getUserAgent();

    /**
     * @param string $method e.g. GET, POST, PUT, DELETE
     * @return RequestInterface
     */
    public function setMethod($method);

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $name
     * @param string|array $value
     * @return mixed
     */
    public function setUriParam($name, $value);

    /**
     * @param array $params
     * @return mixed
     */
    public function setUriParams(array $params);

    /**
     * @param string $name
     * @return string|array
     */
    public function getUriParam($name);

    /**
     * @return array
     */
    public function getUriParams();

    /**
     * @param string $name
     * @param string|array $value
     * @return mixed
     */
    public function setPostParam($name, $value);

    /**
     * @param array $params
     * @return mixed
     */
    public function setPostParams(array $params);

    /**
     * @param string $name
     * @return string|array
     */
    public function getPostParam($name);

    /**
     * @return array
     */
    public function getPostParams();

}
