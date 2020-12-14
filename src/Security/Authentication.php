<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

final class Authentication implements AuthenticationInterface
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
     * {@inheritdoc}
     */
    public static function fromCredentials(
        string $clientId,
        string $clientSecret,
        string $redirectUri
    ): AuthenticationInterface {
        $authentication = new self();
        $authentication->clientId = $clientId;
        $authentication->clientSecret = $clientSecret;
        $authentication->redirectUri = $redirectUri;

        return $authentication;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromTokens(
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        string $accessToken,
        string $refreshToken,
        string $authorizationCode = null,
        int $expirationTime = null
    ): AuthenticationInterface {
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
     * {@inheritdoc}
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccessToken(string $accessToken): AuthenticationInterface
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setRefreshToken(string $refreshToken): AuthenticationInterface
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpirationTime(int $expirationTime): AuthenticationInterface
    {
        $this->expirationTime = $expirationTime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpirationTime(): ?int
    {
        return $this->expirationTime;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthorizationCode(string $authorizationCode): AuthenticationInterface
    {
        $this->authorizationCode = $authorizationCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizationCode(): ?string
    {
        return $this->authorizationCode;
    }

    /**
     * {@inheritdoc}
     */
    public function needAuthentication(): bool
    {
        return is_null($this->getAccessToken());
    }
}
