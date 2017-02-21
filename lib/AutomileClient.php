<?php

namespace Automile\Sdk;

use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\Models\ModelAbstract;
use Automile\Sdk\Models\ModelRowsetAbstract;
use Automile\Sdk\Models\User;
use Automile\Sdk\OAuth\Http as OAuthHttp;
use Automile\Sdk\OAuth\Token;
use Automile\Sdk\Storage\Filesystem;
use Automile\Sdk\Storage\StorageInterface;

use Automile\Sdk\Endpoints\SignUp;
use Automile\Sdk\Endpoints\Vehicle;
use Automile\Sdk\Endpoints\Trip;
use Automile\Sdk\Endpoints\Contact;
use Automile\Sdk\Endpoints\Geofence;
use Automile\Sdk\Endpoints\Notification;
use Automile\Sdk\Endpoints\NotificationMessage;
use Automile\Sdk\Endpoints\Place;
use Automile\Sdk\Endpoints\Device;
use Automile\Sdk\Endpoints\Fleet;
use Automile\Sdk\Endpoints\FleetContact;
use Automile\Sdk\Endpoints\VehicleGeofence;
use Automile\Sdk\Endpoints\VehiclePlace;
use Automile\Sdk\Endpoints\DeviceEvent;
use Automile\Sdk\Endpoints\PublishSubscribe;
use Automile\Sdk\Endpoints\ExpenseReport;

/**
 * Automile PHP SDK Facade object
 * provides a convenient interface to the package
 * @package Automile\Sdk
 */
class AutomileClient
{

    use SignUp, Vehicle, Trip, Contact, Geofence, Notification, NotificationMessage, Place, Device,
        Fleet, FleetContact, VehicleGeofence, VehiclePlace, DeviceEvent, PublishSubscribe, ExpenseReport;

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
     * @throws AutomileException
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

    /**
     * @param string $uri
     * @param ModelRowsetAbstract $rowset
     * @return ModelRowsetAbstract
     * @throws AutomileException
     */
    protected function _getAll($uri, ModelRowsetAbstract $rowset)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($uri);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $rowset->pushMany($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * @param string $uri
     * @param ModelAbstract $model
     * @param int $id
     * @return ModelAbstract
     * @throws AutomileException
     */
    protected function _getById($uri, $id, ModelAbstract $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($uri . '/' . (int)$id);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $model->reset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * @param string $uri
     * @param ModelAbstract $model
     * @return ModelAbstract
     * @throws AutomileException
     */
    protected function _create($uri, ModelAbstract $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($uri)
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $model->reset($response->getBody());
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * @param string $uri
     * @param int $id
     * @param ModelAbstract $vehicle
     * @return ModelAbstract
     * @throws AutomileException
     */
    protected function _edit($uri, $id, ModelAbstract $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($uri . '/' . (int)$id)
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $model;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Removes the given vehicle
     * @param int $id
     * @return bool
     * @throws AutomileException
     */
    protected function _delete($uri, $id)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_DELETE)
            ->setUri($uri . '/' . (int)$id);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
