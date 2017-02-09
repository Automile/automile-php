<?php

namespace Automile\Sdk;

use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\Models\User;
use Automile\Sdk\OAuth\Http as OAuthHttp;
use Automile\Sdk\OAuth\Token;
use Automile\Sdk\Storage\Filesystem;
use Automile\Sdk\Storage\StorageInterface;

use Automile\Sdk\Endpoints\SignUp;
use Automile\Sdk\Endpoints\Vehicle;

/**
 * Automile PHP SDK Facade object
 * provides a convenient interface to the package
 * @package Automile\Sdk
 */
class AutomileClient
{

    use SignUp, Vehicle;

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

        $token = $storage->restore(Token::class);

        return $token ? new self($token) : new self();
    }

    /**
     * @param User $user
     * @return Token
     */
    private function _createToken(User $user)
    {
        $this->_tokenRefreshed = true;

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

    /**
     * set access token to perform API requests
     * @param RequestInterface $request
     * @return RequestInterface
     * @throws AutomileException
     */
    private function _authorizeRequest(RequestInterface $request)
    {
        if (null === $this->_token || !$this->_token->getAccessToken()) {
            throw new AutomileException('Access token is undefined');
        }

        $request->setBearerAuth($this->_token->getAccessToken());

        return $request;
    }

}
