<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

use GuzzleHttp\RequestOptions;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

final class ResourceClient implements ResourceClientInterface
{
    private $baseHttpClient;

    public function __construct(AuthenticatedHttpClientInterface $baseHttpClient)
    {
        $this->baseHttpClient = $baseHttpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->request('GET', $uri, $query);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $verb, string $uri, array $payload = [])
    {
        $payloadIndex = ($verb === 'GET') ? RequestOptions::QUERY : RequestOptions::JSON;

        $params = [
            $payloadIndex => $payload
        ];

        $response = $this->baseHttpClient->request($verb, $uri, $params);

        if (!in_array($response->getStatusCode(), [200, 201, 204])) {
            $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param ResponseInterface $response
     * @return void
     */
    private function handleRequestError(ResponseInterface $response): void
    {
        throw new ResponseException(
            sprintf('Spotify Api Error (%d) : %s', $response->getStatusCode(), $response->getBody())
        );
    }
}
