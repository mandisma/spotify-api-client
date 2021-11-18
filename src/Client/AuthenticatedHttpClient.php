<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;

final class AuthenticatedHttpClient implements ResourceClientInterface
{
    /**
     * @var ClientInterface
     */
    private $baseHttpClient;

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    public function __construct(
        ClientInterface $baseHttpClient,
        AuthorizationInterface $authorization
    ) {
        $this->baseHttpClient = $baseHttpClient;
        $this->authorization = $authorization;
    }

    public function get(string $uri, array $query = []): array
    {
        return $this->request('GET', $uri, [RequestOptions::QUERY => $query]);
    }

    public function post(string $uri, array $payload = []): array
    {
        return $this->request('POST', $uri, [RequestOptions::JSON => $payload]);
    }

    public function put(string $uri, array $payload = []): array
    {
        return $this->request('PUT', $uri, [RequestOptions::JSON => $payload]);
    }

    public function delete(string $uri, array $payload = []): array
    {
        return $this->request('DELETE', $uri, [RequestOptions::JSON => $payload]);
    }

    private function request(string $method, string $uri = '', array $payload = []): array
    {
        $payload[RequestOptions::HEADERS] = $this->getHeaders();

        $response = $this->baseHttpClient->request($method, $uri, $payload);

        if (! in_array($response->getStatusCode(), [200, 201, 204])) {
            throw new ResponseException(
                sprintf('Spotify Api Error (%d) : %s', $response->getStatusCode(), (string) $response->getBody())
            );
        }

        $responseBody = (string) $response->getBody();

        $responseData = json_decode($responseBody, true);

        if (! is_array($responseData)) {
            return [];
        }

        return $responseData;
    }

    /**
     * Get request headers.
     *
     * @return array
     */
    private function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->authorization->getAccessToken()),
        ];
    }
}
