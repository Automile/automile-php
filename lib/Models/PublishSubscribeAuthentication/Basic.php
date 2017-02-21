<?php

namespace Automile\Sdk\Models\PublishSubscribeAuthentication;

use Automile\Sdk\Types\PublishSubscribeAuthenticationType;

/**
 * PublishSubscribeAuthenticationBasic Model
 * @package Automile\Sdk\Models
 */
class Basic extends AuthenticationAbstract
{

    protected $_allowedProperties = [
        'Username',
        'Password'
    ];

    /**
     * @see PublishSubscribeAuthenticationType
     * @return int
     */
    public function getAuthenticationType()
    {
        return PublishSubscribeAuthenticationType::BASIC_USERNAME_PASSWORD;
    }
}
