<?php

namespace Automile\Sdk\Tests\Unit\OAuth;

use Automile\Sdk\OAuth\Token;
use Automile\Sdk\Storage\StorableInterface;
use PHPUnit\Framework\TestCase;

/**
 * Token Unit Tests
 */
class TokenTest extends TestCase
{

    /**
     * @var Token
     */
    private $_token;

    /**
     * @var array
     */
    private $_data = [
        'accessToken' => '12345',
        'refreshToken' => '67890',
        'expiration' => '1893456000',
        'type' => 'bearer'
    ];

    /**
     * setting up the token object
     */
    public function setUp()
    {
        $this->_token = new Token($this->_data['accessToken'], $this->_data['refreshToken'],
            $this->_data['expiration'], $this->_data['type']);

        parent::setUp();
    }

    /**
     * Test Token setter and getter methods
     */
    public function testToken()
    {
        $token = $this->_token;

        $this->assertFalse($token->isExpired());
        $this->assertEquals($this->_data['expiration'], $token->getExpiration());
        $this->assertInstanceOf(Token::class, $token->setExpiration(strtotime('-7 days')));
        $this->assertTrue($token->isExpired());

        $accessToken2 = sha1(rand(1, 9999));
        $this->assertEquals($this->_data['accessToken'], $token->getAccessToken());
        $this->assertInstanceOf(Token::class, $token->setAccessToken($accessToken2));
        $this->assertEquals($accessToken2, $token->getAccessToken());

        $refreshToken2 = sha1(rand(1, 9999));
        $this->assertEquals($this->_data['refreshToken'], $token->getRefreshToken());
        $this->assertInstanceOf(Token::class, $token->setRefreshToken($refreshToken2));
        $this->assertEquals($refreshToken2, $token->getRefreshToken());

        $tokenType2 = 'basic';
        $this->assertEquals($this->_data['type'], $token->getType());
        $this->assertInstanceOf(Token::class, $token->setType($tokenType2));
        $this->assertEquals($tokenType2, $token->getType());
    }

    /**
     * test the Token storage capabilities
     */
    public function testStorage()
    {
        $this->assertInstanceOf(StorableInterface::class, $this->_token);

        $this->assertEquals($this->_data, $this->_token->getStorableData());

        $restored = Token::restoreFromStorage($this->_data);
        $this->assertEquals($this->_data, $restored->getStorableData());
    }

}
