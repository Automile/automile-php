<?php

namespace Automile\Sdk\HttpClient\Response;

/**
 * Class JsonResponse
 * @package Automile\Sdk\HttpClient
 */
class JsonResponse implements ResponseInterface
{

    const LINE_SEPARATOR = "\r\n";

    const SUCCESS_CODE = 200;
    const CREATED_CODE = 201;
    const INTERNAL_ERROR_CODE = 500;

    private $_headers = [];

    private $_statusCode;

    private $_body;

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
     * @param string $headers
     * @return ResponseInterface
     */
    public function setHeaders($headers)
    {
        $headers = explode(self::LINE_SEPARATOR, trim($headers));
        array_shift($headers);

        foreach ($headers as $i => $line) {
            list ($key, $value) = explode(': ', $line);
            $this->_headers[$key] = $value;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * @param int $code
     * @return ResponseInterface
     */
    public function setStatusCode($code)
    {
        $this->_statusCode = $code;
        return $this;
    }

    /**
     * @param bool $raw get raw body instead of a parsed object
     * @return string|\stdClass
     */
    public function getBody($raw = false)
    {
        return $raw ? $this->_body : json_decode($this->_body);
    }

    /**
     * @param string $body
     * @return ResponseInterface
     */
    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return in_array($this->getStatusCode(), [self::SUCCESS_CODE, self::CREATED_CODE]);
    }

    /**
     * @return string|null
     */
    public function getRedirect()
    {
        return self::CREATED_CODE == 201 ? $this->getHeader('Location') : null;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return (bool)$this->getStatusCode();
    }

    /**
     * @return string|null
     */
    public function getErrorMessage()
    {
        if ($this->isSuccessful()) {
            return null;
        }

        $body = $this->getBody();
        if ($body) {
            return empty($body->Message) ? null : $body->Message;
        } else {
            return $this->getBody(true);
        }
    }
}
