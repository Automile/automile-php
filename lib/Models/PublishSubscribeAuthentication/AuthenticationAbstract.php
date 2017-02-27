<?php

namespace Automile\Sdk\Models\PublishSubscribeAuthentication;

use Automile\Sdk\Models\ModelAbstract;
use Automile\Sdk\Types\PublishSubscribeAuthenticationType;

/**
 * PublishSubscribeAuthentication abstract model
 */
abstract class AuthenticationAbstract extends ModelAbstract
{

    /**
     * @see PublishSubscribeAuthenticationType
     * @return int
     */
    abstract public function getAuthenticationType();

}