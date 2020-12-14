<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

use Psr\Http\Message\ResponseInterface;

interface AuthenticatedHttpClientInterface
{
    /**
     * Execute an authenticated request
     *
     * @param string $method Http verb
     * @param string $uri The uri
     * @param array $options
     * @return ResponseInterface
     */
    public function request(string $method, string $uri = '', array $options = []): ResponseInterface;
}
