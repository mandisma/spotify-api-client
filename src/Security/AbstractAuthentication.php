<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Security;

abstract class AbstractAuthentication implements AuthenticationInterface
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
     * @var string|null
     */
    private $accessToken;

    /**
     * @var string|null
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

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        ?string $accessToken = null,
        ?string $refreshToken = null,
        ?string $authorizationCode = null,
        ?int $expirationTime = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->authorizationCode = $authorizationCode;
        $this->expirationTime = $expirationTime;
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
    public function getCredentialsToken(): string
    {
        return base64_encode($this->clientId . ':' . $this->clientSecret);
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
