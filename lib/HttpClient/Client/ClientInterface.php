<?php

namespace Automile\Sdk\HttpClient\Client;

use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\ResponseInterface;

/**
 * ClientInterface should be implemented by any HTTP clients used by the component
 */
interface ClientInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function send(RequestInterface $request, ResponseInterface $response);

    /**
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * @return ResponseInterface
     */
    public function getResponse();

}
