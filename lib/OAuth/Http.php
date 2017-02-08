<?php

namespace Automile\Sdk\OAuth;


use Automile\Sdk\Config;
use Automile\Sdk\HttpClient\ClientInterface;
use Automile\Sdk\HttpClient\Request\RequestInterface;
use Automile\Sdk\HttpClient\Response\ResponseInterface;
use Automile\Sdk\Models\User;

class Http
{

    /**
     * @var ClientInterface
     */
    private $_httpClient;

    /**
     * @var RequestInterface
     */
    private $_request;

    /**
     * @var ResponseInterface
     */
    private $_response;

    /**
     * OAuth client constructor
     * @param ClientInterface $client
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(ClientInterface $client, RequestInterface $request, ResponseInterface $response)
    {
       $this->_httpClient = $client;
       $this->_request = $request;
       $this->_response = $response;
    }

    /**
     * request new OAuth token from the server
     * @param User $user
     * @return Token
     * @throws OAuthException
     */
    public function createToken(User $user)
    {
        $this->_request->setHttpAuth($user->getAPIClientIdentifier(), $user->getAPIClientSecret())
            ->setUri(Config::URI_OAUTH_TOKEN)
            ->setPostParam('grant_type', 'password')
            ->setPostParam('username', $user->getUsername())
            ->setPostParam('password', $user->getPassword());

        $isSuccessful = $this->_httpClient->send($this->_request, $this->_response);

        $body = $this->_response->getBody();
        if ($isSuccessful) {
            if (!isset($body->access_token, $body->token_type, $body->expires_in, $body->refresh_token)) {
                throw new OAuthException('Invalid server response, access token was not created');
            }

            $expiration = time() + $body->expires_in;
            return new Token($body->access_token, $body->refresh_token, $expiration, $body->token_type);
        }

        throw new OAuthException(empty($body->error) ? 'The token was not created' : $body->error);
    }

    /**
     * refresh OAuth token
     * @param User $user
     * @param Token $token old token that needs to be refreshed
     * @return Token
     * @throws OAuthException
     */
    public function refreshToken(User $user, Token $token)
    {
        if (!$token->getRefreshToken()) {
            throw new OAuthException("Refresh token is not defined");
        }

        $this->_request->setHttpAuth($user->getAPIClientIdentifier(), $user->getAPIClientSecret())
            ->setUri(Config::URI_OAUTH_TOKEN)
            ->setPostParam('grant_type', 'refresh_token')
            ->setPostParam('refresh_token', $token->getRefreshToken());

        $isSuccessful = $this->_httpClient->send($this->_request, $this->_response);

        $body = $this->_response->getBody();
        if ($isSuccessful) {
            if (!isset($body->access_token, $body->token_type, $body->expires_in, $body->refresh_token)) {
                throw new OAuthException('Invalid server response, access token was not created');
            }

            $expiration = time() + $body->expires_in;
            return new Token($body->access_token, $body->refresh_token, $expiration, $body->token_type);
        }

        throw new OAuthException(empty($body->error) ? 'The token was not created' : $body->error);
    }

}