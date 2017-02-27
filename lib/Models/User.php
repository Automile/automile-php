<?php

namespace Automile\Sdk\Models;

/**
 * Class User
 *
 * @method string getUsername()
 * @method string getPassword()
 * @method string getAPIClientIdentifier()
 * @method string getAPIClientSecret()
 *
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

    /**
     * Output PHP code to be used by the Automile SDK
     * @return string
     * @see \Automile\Sdk\Config::setUsername()
     * @see \Automile\Sdk\Config::setPassword()
     * @see \Automile\Sdk\Config::setApiClient()
     * @see \Automile\Sdk\Config::setApiSecret()
     */
    public function toPHP()
    {
        return <<<TXT
\Automile\Sdk\Config::setUsername('{$this->getUsername()}');
\Automile\Sdk\Config::setPassword('{$this->getPassword()}');
\Automile\Sdk\Config::setApiClient('{$this->getAPIClientIdentifier()}');
\Automile\Sdk\Config::setApiSecret('{$this->getAPIClientSecret()}');
TXT;

    }

}
