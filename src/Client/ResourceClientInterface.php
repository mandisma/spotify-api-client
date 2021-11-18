<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

interface ResourceClientInterface
{
    public function get(string $uri, array $query = []): array;

    public function post(string $uri, array $payload = []): array;

    public function put(string $uri, array $payload = []): array;

    public function delete(string $uri, array $payload = []): array;
}
