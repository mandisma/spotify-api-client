<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Security\Authentication;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AuthenticationApiTest extends ApiTestCase
{
    private $authorizationCode;

    public function setUp(): void
    {
        parent::setUp();

        $this->authorizationCode = 'authorization_code';

        $this->appAuthentication = new Authentication(
            'client_id',
            'client_secret',
            'redirect_uri',
        );
        $this->userAuthentication = new Authentication(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );
    }

    public function testRequestCredentialsToken()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'foo',
            'expires_in' => 3600
        ])));

        $authenticationApi = new AuthenticationApi($this->httpClient, $this->appAuthentication);
        $authentication = $authenticationApi->requestCredentialsToken();

        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('foo', $authentication->getAccessToken());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testRequestAccessTokenWithCode()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'foo',
            'refresh_token' => 'bar',
            'expires_in' => 3600
        ])));

        $authenticationApi = new AuthenticationApi($this->httpClient, $this->appAuthentication);

        $authentication = $authenticationApi->requestAccessToken($this->authorizationCode);

        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('foo', $authentication->getAccessToken());
        $this->assertEquals('bar', $authentication->getRefreshToken());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testRequestAccessTokenWithoutCode()
    {
        $authenticationApi = new AuthenticationApi($this->httpClient, $this->appAuthentication);

        $this->expectException(\Exception::class);

        $authentication = $authenticationApi->requestAccessToken();
    }

    public function testRefreshAccessToken()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'foo',
            'refresh_token' => 'bar',
            'expires_in' => 3600
        ])));

        $authenticationApi = new AuthenticationApi($this->httpClient, $this->userAuthentication);

        $authentication = $authenticationApi->refreshAccessToken();

        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('foo', $authentication->getAccessToken());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testRefreshAccessTokenError()
    {
        $authenticationApi = new AuthenticationApi($this->httpClient, $this->appAuthentication);

        $this->expectException(\Exception::class);

        $authentication = $authenticationApi->refreshAccessToken();
    }

    /**
     * @runInSeparateProcess
     */
    public function testRequestAuthorizationCode()
    {
        $authenticationApi = new AuthenticationApi($this->httpClient, $this->userAuthentication);
        $scopes = ['user-read-playback-state'];

        $authenticationApi->requestAuthorizationCode($scopes);

        $expectedLocation = 'https://accounts.spotify.com/authorize?client_id=client_id&response_type=code&redirect_uri=redirect_uri&scope=user-read-playback-state';

        $this->assertContains(
            'Location: ' . $expectedLocation,
            xdebug_get_headers()
        );

    }
}
