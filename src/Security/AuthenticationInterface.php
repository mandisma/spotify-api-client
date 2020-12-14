<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

interface AuthenticationInterface
{
    /**
     * Create an authentication object with credentials
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @return AuthenticationInterface
     */
    public static function fromCredentials(
        string $clientId,
        string $clientSecret,
        string $redirectUri
    ): AuthenticationInterface;

    /**
     * Create an authentication object with credentials and tokens
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param string $accessToken
     * @param string $refreshToken
     * @param string|null $authorizationCode
     * @param integer|null $expirationTime
     * @return AuthenticationInterface
     */
    public static function fromTokens(
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        string $accessToken,
        string $refreshToken,
        string $authorizationCode = null,
        int $expirationTime = null
    ): AuthenticationInterface;

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
