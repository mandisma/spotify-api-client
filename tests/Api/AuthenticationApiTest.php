<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Security\Authentication;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AuthenticationApiTest extends ApiTestCase
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $authorizationCode;
    private $refreshToken;

    public function setUp(): void
    {
        parent::setUp();

        $this->clientId = 'client_id';
        $this->clientSecret = 'client_secret';
        $this->authorizationCode = 'authorization_code';
        $this->refreshToken = 'refresh_token';
        $this->redirectUri = 'https://example.com/callback';
    }

    public function testRequestCredentialsToken()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'foo',
            'expires_in' => 3600
        ])));

        $authentication = Authentication::fromCredentials($this->clientId, $this->clientSecret, $this->redirectUri);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);
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

        $authentication = Authentication::fromCredentials($this->clientId, $this->clientSecret, $this->redirectUri);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);

        $authentication = $authenticationApi->requestAccessToken($this->authorizationCode);

        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('foo', $authentication->getAccessToken());
        $this->assertEquals('bar', $authentication->getRefreshToken());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testRequestAccessTokenWithoutCode()
    {
        $authentication = Authentication::fromCredentials($this->clientId, $this->clientSecret, $this->redirectUri);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);

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

        $authentication = Authentication::fromTokens($this->clientId, $this->clientSecret, $this->redirectUri, 'access_token', $this->refreshToken);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);

        $authentication = $authenticationApi->refreshAccessToken();

        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertEquals('foo', $authentication->getAccessToken());
        $this->assertEquals(3600, $authentication->getExpirationTime());
    }

    public function testRefreshAccessTokenError()
    {
        $authentication = Authentication::fromCredentials($this->clientId, $this->clientSecret, $this->redirectUri);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);

        $this->expectException(\Exception::class);

        $authentication = $authenticationApi->refreshAccessToken();
    }

    /**
     * @runInSeparateProcess
     */
    public function testRequestAuthorizationCode()
    {
        $authentication = Authentication::fromTokens($this->clientId, $this->clientSecret, $this->redirectUri, 'access_token', $this->refreshToken);
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);
        $scopes = ['user-read-playback-state'];

        $authenticationApi->requestAuthorizationCode($scopes);

        $expectedLocation = 'https://accounts.spotify.com/authorize?client_id=client_id&response_type=code&redirect_uri=https%3A%2F%2Fexample.com%2Fcallback&scope=user-read-playback-state';

        $this->assertContains(
            'Location: ' . $expectedLocation,
            xdebug_get_headers()
        );

    }
}
