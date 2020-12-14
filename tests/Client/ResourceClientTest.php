<?php

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Client\ResourceClient;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Mandisma\SpotifyApiClient\Security\Authentication;
use PHPUnit\Framework\TestCase;

class ResourceClientTest extends ApiTestCase
{
    public function testHandleError(): void
    {
        $authentication = Authentication::fromTokens('client_id', 'client_secret', 'redirect_uri', 'access_token', 'refresh_token');
        $authenticationApi = new AuthenticationApi($this->httpClient, $authentication);
        $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $authenticationApi);
        $resourceClient = new ResourceClient($authenticatedHttpClient);

        $this->mockHandler->append(new Response(500));

        $this->expectException(ResponseException::class);

        $resourceClient->get('/test');
    }
}
