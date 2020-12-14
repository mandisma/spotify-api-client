<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

interface ResourceClientInterface
{
    /**
     * Make a GET request to Forge servers and return the response.
     *
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array;

    /**
     * Make a POST request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function post(string $uri, array $payload = []);

    /**
     * Make a PUT request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function put(string $uri, array $payload = []);

    /**
     * Make a DELETE request to Forge servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function delete(string $uri, array $payload = []);

    /**
     * Make request to Forge servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    public function request(string $verb, string $uri, array $payload = []);
}
