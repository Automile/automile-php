<?php

namespace Automile\Sdk\Models;


class SignUp extends ModelAbstract
{

    /**
     * allowed properties for the SignUp model
     * @var array
     */
    protected $_allowedProperties = [
        'Username', 'Password', 'APIClientIdentifier', 'APIClientSecret'
    ];

}