<?php

namespace Mandisma\SpotifyApiClient\Tests\Security;

use Mandisma\SpotifyApiClient\Security\Authentication;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    public function testFromTokens()
    {
        $authentication = Authentication::fromTokens('client_id', 'client_secret', 'redirect_uri', 'access_token', 'refresh_token', 'authorization_code', 3600);
        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('client_id', $authentication->getClientId());
        $this->assertEquals('client_secret', $authentication->getClientSecret());
        $this->assertEquals('redirect_uri', $authentication->getRedirectUri());
        $this->assertEquals('access_token', $authentication->getAccessToken());
        $this->assertEquals('refresh_token', $authentication->getRefreshToken());
        $this->assertEquals('authorization_code', $authentication->getAuthorizationCode());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testFromCredentials()
    {
        $authentication = Authentication::fromCredentials('client_id', 'client_secret', 'redirect_uri');
        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('client_id', $authentication->getClientId());
        $this->assertEquals('client_secret', $authentication->getClientSecret());
        $this->assertEquals('redirect_uri', $authentication->getRedirectUri());
    }
}
