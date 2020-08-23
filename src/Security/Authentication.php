<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

final class Authentication
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var string|null
     */
    private $authorizationCode;

    /**
     * @var int|null
     */
    private $expirationTime;

    /**
     * @var string
     */
    private $redirectUri;

    protected function __construct()
    {
    }

    /**
     * Create an authentication object with credentials
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @return Authentication
     */
    public static function fromCredentials(string $clientId, string $clientSecret, string $redirectUri): Authentication
    {
        $authentication = new self();
        $authentication->clientId = $clientId;
        $authentication->clientSecret = $clientSecret;
        $authentication->redirectUri = $redirectUri;

        return $authentication;
    }

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
     * @return Authentication
     */
    public static function fromTokens(
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        string $accessToken,
        string $refreshToken,
        string $authorizationCode = null,
        int $expirationTime = null
    ): Authentication {
        $authentication = new self();
        $authentication->clientId = $clientId;
        $authentication->clientSecret = $clientSecret;
        $authentication->redirectUri = $redirectUri;
        $authentication->accessToken = $accessToken;
        $authentication->refreshToken = $refreshToken;
        $authentication->authorizationCode = $authorizationCode;
        $authentication->expirationTime = $expirationTime;

        return $authentication;
    }

    /**
     * Get the client id
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Get the client secret
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * Initialize an access token
     *
     * @param string $accessToken
     * @return Authentication
     */
    public function setAccessToken(string $accessToken): Authentication
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get the access token
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Initialize a refresh token
     *
     * @param string $refreshToken
     * @return Authentication
     */
    public function setRefreshToken(string $refreshToken): Authentication
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get the refresh token
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Set an expiration time
     *
     * @param integer $expirationTime
     * @return Authentication
     */
    public function setExpirationTime(int $expirationTime): Authentication
    {
        $this->expirationTime = $expirationTime;

        return $this;
    }

    /**
     * Get the expiration time of the token
     *
     * @return integer|null
     */
    public function getExpirationTime(): ?int
    {
        return $this->expirationTime;
    }

    /**
     * Get the redirect Uri
     *
     * @return string|null
     */
    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    /**
     * Set an authorization code
     *
     * @param string $authorizationCode
     * @return Authentication
     */
    public function setAuthorizationCode(string $authorizationCode): Authentication
    {
        $this->authorizationCode = $authorizationCode;
        return $this;
    }

    /**
     * Get the authorization code
     *
     * @return string|null
     */
    public function getAuthorizationCode(): ?string
    {
        return $this->authorizationCode;
    }

    /**
     * Return true if the token is expired or if the access_token is null
     *
     * @return boolean
     */
    public function needAuthentication(): bool
    {
        return is_null($this->getAccessToken());
    }
}
