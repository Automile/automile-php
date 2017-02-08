<?php

namespace Automile\Sdk;

use Automile\Sdk\HttpClient\ClientInterface;
use Automile\Sdk\HttpClient\Curl;
use Automile\Sdk\HttpClient\Request\HttpRequest;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\JsonResponse;
use Automile\Sdk\HttpClient\Response\ResponseInterface;
use Automile\Sdk\Models\User;
use Automile\Sdk\OAuth\Http as OAuthHttp;
use Automile\Sdk\OAuth\Token;
use Automile\Sdk\Storage\Filesystem;
use Automile\Sdk\Storage\StorageInterface;

/**
 * Automile PHP SDK Facade object
 * provides a convenient interface to the package
 * @package Automile\Sdk
 */
class AutomileClient
{

    /**
     * @var User
     */
    private $_user;

    /**
     * @var Token
     */
    private $_token;

    /**
     * whether the OAuth Token has been refreshed
     * @var bool
     */
    private $_tokenRefreshed = false;

    /**
     * Initialize and/or authenticate the client
     * @param User|Token $user
     */
    public function __construct($user = null)
    {
        if ($user instanceof User) {
            $this->_user = $user;
            Config::setUser($user);
        } elseif ($user instanceof Token) {
            $this->_token = $user;
        }

        if (null === $this->_user) {
            $username = Config::getUsername();
            $password = Config::getPassword();
            $apiClient = Config::getApiClient();
            $apiSecret = Config::getApiSecret();

            if (!$username || !$password || !$apiClient || !$apiSecret) {
                throw new AutomileException("User credentials are not configured");
            }

            $model = new User();
            $model->setUsername($username)
                ->setPassword($password)
                ->setAPIClientIdentifier($apiClient)
                ->setAPIClientSecret($apiSecret);

            $this->_user = $model;
        }

        if (null !== $this->_user && null === $this->_token) {
            $this->_token = $this->_createToken($this->_user);
        }

        if (null !== $this->_user && null !== $this->_token && $this->_token->isExpired()) {
            $this->_token = $this->_refreshToken($this->_user, $this->_token);
        }
    }

    /**
     * @param string $email
     * @return User
     * @throws AutomileException
     */
    public static function signUp($email)
    {
        if (!$email) {
            throw new AutomileException('Email is required');
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $request->setUri(Config::URI_SIGNUP)
            ->setMethod(Config::METHOD_POST)
            ->setPostParam('email', $email);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new User($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * @param string|StorageInterface $storage path to the storage file or a storage object itself
     * @return bool
     */
    public function saveToken($storage)
    {
        if (null === $this->_token || !$this->_tokenRefreshed) {
            return false;
        }

        if (!$storage instanceof StorageInterface) {
            $path = $storage;
            $storage = new Filesystem();
            $storage->setFilePath($path);
        }

        return $storage->save($this->_token);
    }

    /**
     * @param string|StorageInterface $storage path to the storage file or a storage object itself
     * @return AutomileClient
     */
    public static function fromSavedToken($storage)
    {
        if (!$storage instanceof StorageInterface) {
            $path = $storage;
            $storage = new Filesystem();
            $storage->setFilePath($path);
        }

        return new self($storage->restore(Token::class));
    }

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
     * @param string $httpClient
     * @return AutomileClient
     * @throws AutomileException
     */
    public function setHttpClientClass($httpClient)
    {
        if (!class_exists($httpClient)) {
            throw new AutomileException("HTTP Client class '{$httpClient}' not found");
        }

        $this->_httpClientClass = $httpClient;
        return $this;
    }

    /**
     * @param User $user
     * @return Token
     */
    private function _createToken(User $user)
    {
        $http = new OAuthHttp(Config::getNewHttpClient(), Config::getNewRequest(), Config::getNewResponse());
        return $http->createToken($user);
    }

    /**
     * @param User $user
     * @param Token $token
     * @return Token new token
     */
    private function _refreshToken(User $user, Token $token)
    {
        $http = new OAuthHttp(Config::getNewHttpClient(), Config::getNewRequest(), Config::getNewResponse());
        $newToken = $http->refreshToken($user, $token);
        $this->_tokenRefreshed = $newToken->getAccessToken() != $token->getAccessToken();

        return $newToken;
    }

}
