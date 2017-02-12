<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\User;

/**
 * SignUp Trait to be used in AutomileClient
 * @package Automile\Sdk\Clients
 */
trait SignUp
{

    private static $_signUpUri = 'signup';

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

        $request->setUri(self::$_signUpUri)
            ->setMethod(Config::METHOD_POST)
            ->setPostParam('email', $email);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new User($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
