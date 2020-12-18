<?php

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Client\ResourceClient;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Mandisma\SpotifyApiClient\Security\Authentication;

class ResourceClientTest extends ApiTestCase
{
//     public function testHandleError(): void
//     {
//         $authentication = new Authentication('client_id', 'client_secret', 'redirect_uri', 'access_token', 'refresh_token');
//         $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $authentication);
//         $resourceClient = new ResourceClient($authenticatedHttpClient);

//         $this->mockHandler->append(new Response(500));

//         $this->expectException(ResponseException::class);

//         $resourceClient->get('/test');
//     }
}
