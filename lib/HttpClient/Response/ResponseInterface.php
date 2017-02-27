<?php

namespace Automile\Sdk\HttpClient\Response;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{

    /**
     * @param string $header
     * @return string|null
     */
    public function getHeader($header);

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param string $headers
     * @return ResponseInterface
     */
    public function setHeaders($headers);

    /**
     * @return int
     */
    public function getStatusCode();

    /**
     * @param int $code
     * @return ResponseInterface
     */
    public function setStatusCode($code);

    /**
     * @param bool $raw get raw body instead of a parsed object
     * @return string|\stdClass
     */
    public function getBody($raw = false);

    /**
     * @param string $body
     * @return ResponseInterface
     */
    public function setBody($body);

    /**
     * @return bool
     */
    public function isSuccessful();

    /**
     * @return string|null
     */
    public function getRedirect();

    /**
     * @return bool
     */
    public function isCompleted();

    /**
     * @return string|null
     */
    public function getErrorMessage();

}
