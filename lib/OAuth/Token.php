<?php

namespace Automile\Sdk\OAuth;


use Automile\Sdk\Storage\StorableInterface;

class Token implements StorableInterface
{

    /**
     * @var string
     */
    private $_accessToken;

    /**
     * @var string
     */
    private $_refreshToken;

    /**
     * Access Token expiration date
     * @var string
     */
    private $_expiration;


    private $_type;

    /**
     * Initialize the object
     * @param string $accessToken
     * @param string $refreshToken
     * @param string $expiration access token expiration date in unit timestamp
     * @param string $type
     */
    public function __construct($accessToken, $refreshToken, $expiration, $type)
    {
        $this->_accessToken = $accessToken;
        $this->_refreshToken = $refreshToken;
        $this->_expiration = $expiration;
        $this->_type = $type;
    }

    public function isExpired()
    {
        if (!$this->_expiration) {
            throw new OAuthException('Expiration date is undefined');
        }

        return $this->_expiration <= time();
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * @param string $accessToken
     * @return Token
     */
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->_refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return Token
     */
    public function setRefreshToken($refreshToken)
    {
        $this->_refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiration()
    {
        return $this->_expiration;
    }

    /**
     * @param string $expiration
     * @return Token
     */
    public function setExpiration($expiration)
    {
        $this->_expiration = $expiration;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $type
     * @return Token
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * key-value pairs of data to be stored
     * @return array
     */
    public function getStorableData()
    {
        return [
            'accessToken' => $this->_accessToken,
            'refreshToken' => $this->_refreshToken,
            'expiration' => $this->_expiration,
            'type' => $this->_type
        ];
    }

    /**
     * create an object from the stored data
     * @param array $data key-value pairs that were previously stored
     * @return StorableInterface
     * @throws OAuthException
     */
    public static function restoreFromStorage(array $data)
    {
        if (!isset($data['accessToken'], $data['type'], $data['expiration'], $data['refreshToken'])) {
            throw new OAuthException('Access token was not created, data is missing');
        }

        return new self($data['accessToken'], $data['refreshToken'], $data['expiration'], $data['type']);
    }
}
