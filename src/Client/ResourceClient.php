<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

use GuzzleHttp\RequestOptions;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

final class ResourceClient
{
    private $baseHttpClient;

    public function __construct(AuthenticatedHttpClient $baseHttpClient)
    {
        $this->baseHttpClient = $baseHttpClient;
    }

    /**
     * Make a GET request to Forge servers and return the response.
     *
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->request('GET', $uri, $query);
    }

    /**
     * Make a POST request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function put(string $uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Make a DELETE request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function delete(string $uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Make request to Forge servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
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
        throw new ResponseException(sprintf('Spotify Api Error (%d) : %s', $response->getStatusCode(), $response->getBody()));
    }
}
