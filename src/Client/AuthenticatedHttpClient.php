<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

final class AuthenticatedHttpClient extends AbstractHttpClient
{
    protected function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->authentication->getAccessToken()),
        ];
    }
}
