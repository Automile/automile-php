<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\User;

/**
 * SignUp Trait to be used in AutomileClient
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
            ->setContentType('application/x-www-form-urlencoded')
            ->setPostParam('email', $email);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new User($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
