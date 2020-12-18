<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;

interface AuthenticationApiInterface
{
    /**
     * Request an access token using the Client Credentials Flow.
     *
     * @return AuthenticationInterface
     */
    public function requestCredentialsToken(): AuthenticationInterface;

    /**
     * Request an access token using the Authorization Code Flow
     *
     * @param string $code The Authorization Code
     * @return AuthenticationInterface
     */
    public function requestAccessToken(string $code): AuthenticationInterface;

    /**
     * Refresh the access token
     *
     * @return AuthenticationInterface
     */
    public function refreshAccessToken(string $refreshToken): AuthenticationInterface;

    /**
     * Request an user authorization code
     *
     * @param array $scopes
     *
     * @return bool
     */
    public function requestAuthorizationCode(array $scopes): bool;

    /**
     * Get the authentication class
     *
     * @return AuthenticationInterface
     */
    public function getAuthentication(): AuthenticationInterface;
}
