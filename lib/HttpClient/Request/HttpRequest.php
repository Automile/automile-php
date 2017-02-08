<?php

namespace Automile\Sdk\HttpClient\Request;

/**
 * Class Http
 * @package Automile\Sdk\HttpClient
 */
class HttpRequest implements RequestInterface
{

    /**
     * remote URI
     * @var string
     */
    private $_uri;

    /**
     * @var array
     */
    private $_headers = [];

    /**
     * @var string
     */
    private $_method = 'get';

    /**
     * @var array
     */
    private $_paramsUri = [];

    /**
     * @var array
     */
    private $_paramsPost = [];

    /**
     * @param string $uri
     * @return RequestInterface
     */
    public function setUri($uri)
    {
        $this->_uri = $uri;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * @param string $header
     * @param string $value
     * @return RequestInterface
     */
    public function setHeader($header, $value)
    {
        $this->_headers[$header] = $value;
        return $this;
    }

    /**
     * @param array $headers
     * @return RequestInterface
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = array_merge($this->_headers, $headers);
        return $this;
    }

    /**
     * @param string $header
     * @return string|null
     */
    public function getHeader($header)
    {
        return array_key_exists($header, $this->_headers) ? $this->_headers[$header] : null;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * @param string $header
     * @return RequestInterface
     */
    public function unsetHeader($header)
    {
        if (array_key_exists($header, $this->_headers)) {
            unset($this->_headers[$header]);
        }

        return $this;
    }

    /**
     * @param string $method e.g. GET, POST, PUT, DELETE
     * @return RequestInterface
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtolower($this->_method);
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return mixed
     */
    public function setUriParam($name, $value)
    {
        $this->_paramsUri[$name] = $name;
        return $this;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function setUriParams(array $params)
    {
        $this->_paramsUri = array_merge($this->_paramsUri, $params);
        return $this;
    }

    /**
     * @param string $name
     * @return string|array
     */
    public function getUriParam($name)
    {
        return array_key_exists($name, $this->_paramsUri) ? $this->_paramsUri[$name] : null;
    }

    /**
     * @return array
     */
    public function getUriParams()
    {
        return $this->_paramsUri;
    }

    /**
     * @param string $name
     * @param string|array $value
     * @return mixed
     */
    public function setPostParam($name, $value)
    {
        $this->_paramsPost[$name] = $value;
        return $this;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function setPostParams(array $params)
    {
        $this->_paramsPost = array_merge($this->_paramsPost, $params);
        return $this;
    }

    /**
     * @param string $name
     * @return string|array
     */
    public function getPostParam($name)
    {
        return array_key_exists($name, $this->_paramsPost) ? $this->_paramsPost[$name] : null;
    }

    /**
     * @return array
     */
    public function getPostParams()
    {
        return $this->_paramsPost;
    }

    /**
     * @param string $userAgent
     * @return RequestInterface
     */
    public function setUserAgent($userAgent)
    {
        $this->setHeader('User-Agent', $userAgent);
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->getHeader('User-Agent');
    }

    /**
     * @param string $username
     * @param string $password
     * @return RequestInterface
     */
    public function setHttpAuth($username, $password)
    {
        $hash = base64_encode($username . ':' . $password);
        $this->setHeader('Authorization', "Basic {$hash}");

        return $this;
    }

    /**
     * @return RequestInterface
     */
    public function unsetHttpAuth()
    {
        $this->unsetHeader('Authorization');
    }
}