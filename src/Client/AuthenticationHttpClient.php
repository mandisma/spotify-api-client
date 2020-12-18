<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

final class AuthenticationHttpClient extends AbstractHttpClient
{
    protected function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Basic %s', $this->authentication->getCredentialsToken()),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
    }
}
