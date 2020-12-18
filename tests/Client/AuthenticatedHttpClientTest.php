<?php

namespace Mandisma\SpotifyApiClient\Tests\Client;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Security\Authentication;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AuthenticatedHttpClientTest extends ApiTestCase
{
    // public function testAuthenticate(): void
    // {
    //     $this->mockHandler->append(new Response(200, [], json_encode(['access_token' => 'access_token', 'expires_in' => 3600])));
    //     $this->mockHandler->append(new Response(200));

    //     $authentication = new Authentication('client_id', 'client_secret', 'redirect_uri');
    //     $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $authentication);

    //     $authenticatedHttpClient->request('GET', 'test');

    //     $this->assertEquals('access_token', $authentication->getAccessToken());
    //     $this->assertEquals(3600, $authentication->getExpirationTime());
    // }
}