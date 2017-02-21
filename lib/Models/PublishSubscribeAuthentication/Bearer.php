<?php

namespace Automile\Sdk\Models\PublishSubscribeAuthentication;

use Automile\Sdk\Types\PublishSubscribeAuthenticationType;

/**
 * Class Bearer
 * @package Automile\Sdk\Models
 */
class Bearer extends AuthenticationAbstract
{

    protected $_allowedProperties = [
        'BearerToken'
    ];

    /**
     * @see PublishSubscribeAuthenticationType
     * @return int
     */
    public function getAuthenticationType()
    {
        return PublishSubscribeAuthenticationType::BEARER_TOKEN;
    }
}
