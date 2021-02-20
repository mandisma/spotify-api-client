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
    protected $authorization;

    /**
     * @param ClientInterface $baseHttpClient
     * @param AuthorizationInterface $authorization
     */
    public function __construct(
        ClientInterface $baseHttpClient,
        AuthorizationInterface $authorization
    ) {
        $this->baseHttpClient = $baseHttpClient;
        $this->authorization = $authorization;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->request('GET', $uri, [RequestOptions::QUERY => $query]);
    }

    /**
     * @return mixed
     */
    public function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, [RequestOptions::JSON => $payload]);
    }

    /**
     * @return mixed
     */
    public function put(string $uri, array $payload = [])
    {
        return $this->request('PUT', $uri, [RequestOptions::JSON => $payload]);
    }

    /**
     * @return mixed
     */
    public function delete(string $uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, [RequestOptions::JSON => $payload]);
    }

    /**
     * @return mixed
     */
    private function request(string $method, string $uri = '', array $payload = [])
    {
        $params[RequestOptions::HEADERS] = $this->getHeaders();

        $response = $this->baseHttpClient->request($method, $uri, $payload);

        if (!in_array($response->getStatusCode(), [200, 201, 204])) {
            throw new ResponseException(
                sprintf('Spotify Api Error (%d) : %s', $response->getStatusCode(), $response->getBody())
            );
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * Get request headers.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->authorization->getAccessToken()),
        ];
    }
}
