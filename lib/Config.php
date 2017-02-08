<?php

namespace Automile\Sdk;


use Automile\Sdk\HttpClient\ClientInterface;
use Automile\Sdk\HttpClient\Curl;
use Automile\Sdk\HttpClient\Request\HttpRequest;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\JsonResponse;
use Automile\Sdk\HttpClient\Response\ResponseInterface;
use Automile\Sdk\Models\User;

class Config
{

    const VERSION = '0.1';

    const USER_AGENT = 'Automile-PHP-SDK v' . self::VERSION;

    const URL = 'https://api.automile.com';

    const URI_SIGNUP = 'signup';
    const URI_OAUTH_TOKEN = 'OAuth2/Token';

    const METHOD_POST = 'post';
    const METHOD_GET = 'get';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    /**
     * @var string
     */
    private static $_username;

    /**
     * @var string
     */
    private static $_password;

    /**
     * @var string
     */
    private static $_apiClient;

    /**
     * @var string
     */
    private static $_apiSecret;

    /**
     * @var RequestInterface
     */
    private static $_requestClass;

    /**
     * @var ResponseInterface
     */
    private static $_responseClass;

    /**
     * @var ClientInterface
     */
    private static $_httpClientClass;

    /**
     * @param string $request
     * @return bool
     * @throws AutomileException
     */
    public static function setRequestClass($request)
    {
        if (!class_exists($request)) {
            throw new AutomileException("Request class '{$request}' not found");
        }

        self::$_requestClass = $request;

        return true;
    }

    /**
     * @param string $response
     * @return bool
     * @throws AutomileException
     */
    public static function setResponseClass($response)
    {
        if (!class_exists($response)) {
            throw new AutomileException("Response class '{$response}' not found");
        }

        self::$_responseClass = $response;

        return true;
    }

    /**
     * @param string $httpClient
     * @return bool
     * @throws AutomileException
     */
    public static function setHttpClientClass($httpClient)
    {
        if (!class_exists($httpClient)) {
            throw new AutomileException("HTTP Client class '{$httpClient}' not found");
        }

        self::$_httpClientClass = $httpClient;

        return true;
    }

    /**
     * @return RequestInterface
     * @throws AutomileException
     */
    public static function getNewRequest()
    {
        $request = self::$_requestClass ? new self::$_requestClass : new HttpRequest();
        if (!$request instanceof RequestInterface) {
            throw new AutomileException("Request class '" . self::$_requestClass . "' should implement RequestInterface");
        }

        return $request;
    }

    /**
     * @return ResponseInterface
     * @throws AutomileException
     */
    public static function getNewResponse()
    {
        $response = self::$_responseClass ? new self::$_responseClass : new JsonResponse();
        if (!$response instanceof ResponseInterface) {
            throw new AutomileException("Response class '" . self::$_responseClass . "' should implement ResponseInterface");
        }

        return $response;
    }

    /**
     * @return ClientInterface
     * @throws AutomileException
     */
    public static function getNewHttpClient()
    {
        $client = self::$_httpClientClass ? new self::$_httpClientClass : new Curl();
        if (!$client instanceof ClientInterface) {
            throw new AutomileException("HTTP Client class '" . self::$_httpClientClass . "' should implement ClientInterface");
        }

        return $client;
    }

    /**
     * @return string
     */
    public static function getUsername()
    {
        return self::$_username;
    }

    /**
     * @param string $username
     * @return bool
     */
    public static function setUsername($username)
    {
        self::$_username = $username;
        return true;
    }

    /**
     * @return string
     */
    public static function getPassword()
    {
        return self::$_password;
    }

    /**
     * @param string $password
     * @return bool
     */
    public static function setPassword($password)
    {
        self::$_password = $password;
        return true;
    }

    /**
     * @return string
     */
    public static function getApiClient()
    {
        return self::$_apiClient;
    }

    /**
     * @param string $apiClient
     * @return bool
     */
    public static function setApiClient($apiClient)
    {
        self::$_apiClient = $apiClient;
        return true;
    }

    /**
     * @return string
     */
    public static function getApiSecret()
    {
        return self::$_apiSecret;
    }

    /**
     * @param string $apiSecret
     * @return bool
     */
    public static function setApiSecret($apiSecret)
    {
        self::$_apiSecret = $apiSecret;
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function setUser(User $user)
    {
        self::setUsername($user->getUsername());
        self::setPassword($user->getPassword());
        self::setApiClient($user->getAPIClientIdentifier());
        self::setApiSecret($user->getAPIClientSecret());
    }

}
