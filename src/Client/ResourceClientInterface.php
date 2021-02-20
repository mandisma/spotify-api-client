<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

interface ResourceClientInterface
{
    /**
     * @return array
     */
    public function get(string $uri, array $query = []): array;

    /**
     * @return mixed
     */
    public function post(string $uri, array $payload = []);

    /**
     * @return mixed
     */
    public function put(string $uri, array $payload = []);

    /**
     * @return mixed
     */
    public function delete(string $uri, array $payload = []);
}
