<?php

namespace Automile\Sdk;

use Automile\Sdk\HttpClient\Curl;
use Automile\Sdk\HttpClient\Request\HttpRequest;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\JsonResponse;
use Automile\Sdk\HttpClient\Response\ResponseInterface;
use Automile\Sdk\Models;

/**
 * Automile PHP SDK Facade object
 * provides a convenient interface to the package
 * @package Automile\Sdk
 */
class AutomileClient
{

    /**
     * @var RequestInterface
     */
    private $_requestClass;

    /**
     * @var ResponseInterface
     */
    private $_responseClass;

    /**
     * @param string $request
     * @return AutomileClient
     * @throws AutomileException
     */
    public function setRequestClass($request)
    {
        if (!class_exists($request)) {
            throw new AutomileException("Request class '{$request}' not found");
        }

        $this->_requestClass = $request;
        return $this;
    }

    /**
     * @param string $response
     * @return AutomileClient
     * @throws AutomileException
     */
    public function setResponseClass($response)
    {
        if (!class_exists($response)) {
            throw new AutomileException("Response class '{$response}' not found");
        }

        $this->_responseClass = $response;
        return $this;
    }

    /**
     * @param string $email
     * @return Models\SignUp
     * @throws AutomileException
     */
    public function signUp($email)
    {
        if (!$email) {
            throw new AutomileException('Email is required');
        }

        $request = $this->_requestClass ? new $this->_requestClass : new HttpRequest();
        if (!$request instanceof RequestInterface) {
            throw new AutomileException("Request class '{$this->_requestClass}' should implement RequestInterface");
        }

        $response = $this->_responseClass ? new $this->_responseClass : new JsonResponse();
        if (!$response instanceof ResponseInterface) {
            throw new AutomileException("Response class '{$this->_responseClass}' should implement ResponseInterface");
        }

        $request->setUri(Config::URL_SIGNUP)
            ->setMethod(Config::METHOD_POST)
            ->setPostParam('email', $email);

        $client = new Curl();
        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Models\SignUp($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }
}