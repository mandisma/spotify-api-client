<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

interface AuthorizationInterface
{
    /**
     * Get the access token.
     *
     * @return string
     */
    public function getAccessToken(): string;
}
