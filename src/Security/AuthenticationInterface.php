<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

interface AuthenticationInterface
{
    /**
     * Get the client id
     *
     * @return string
     */
    public function getClientId(): string;

    /**
     * Get the client secret
     *
     * @return string
     */
    public function getClientSecret(): string;

    /**
     * Get the credentials token
     *
     * @return string
     */
    public function getCredentialsToken(): string;

    /**
     * Initialize an access token
     *
     * @param string $accessToken
     * @return AuthenticationInterface
     */
    public function setAccessToken(string $accessToken): AuthenticationInterface;

    /**
     * Get the access token
     *
     * @return string|null
     */
    public function getAccessToken(): ?string;

    /**
     * Initialize a refresh token
     *
     * @param string $refreshToken
     * @return AuthenticationInterface
     */
    public function setRefreshToken(string $refreshToken): AuthenticationInterface;

    /**
     * Get the refresh token
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string;

    /**
     * Set an expiration time
     *
     * @param integer $expirationTime
     * @return AuthenticationInterface
     */
    public function setExpirationTime(int $expirationTime): AuthenticationInterface;

    /**
     * Get the expiration time of the token
     *
     * @return integer|null
     */
    public function getExpirationTime(): ?int;

    /**
     * Get the redirect Uri
     *
     * @return string|null
     */
    public function getRedirectUri(): ?string;

    /**
     * Set an authorization code
     *
     * @param string $authorizationCode
     * @return AuthenticationInterface
     */
    public function setAuthorizationCode(string $authorizationCode): AuthenticationInterface;

    /**
     * Get the authorization code
     *
     * @return string|null
     */
    public function getAuthorizationCode(): ?string;

    /**
     * Return true if the token is expired or if the access_token is null
     *
     * @return boolean
     */
    public function needAuthentication(): bool;
}
