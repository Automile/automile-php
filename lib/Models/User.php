<?php

namespace Automile\Sdk\Models;

/**
 * Class User
 * @package Automile\Sdk\Models
 * @method string getUsername()
 * @method string getPassword()
 * @method string getAPIClientIdentifier()
 * @method string getAPIClientSecret()
 * @method User setUsername(string $username)
 * @method User setPassword(string $password)
 * @method User setAPIClientIdentifier(string $apiClient)
 * @method User setAPIClientSecret(string $apiSecret)
 */
class User extends ModelAbstract
{

    /**
     * allowed properties for the SignUp model
     * @var array
     */
    protected $_allowedProperties = [
        'Username', 'Password', 'APIClientIdentifier', 'APIClientSecret'
    ];

    public function __toString()
    {
        return <<<TXT
\Automile\Sdk\Config::setUsername('{$this->getUsername()}');
\Automile\Sdk\Config::setPassword('{$this->getPassword()}');
\Automile\Sdk\Config::setApiClient('{$this->getAPIClientIdentifier()}');
\Automile\Sdk\Config::setApiSecret('{$this->getAPIClientSecret()}');
TXT;

    }

}
