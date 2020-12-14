<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;

interface ClientBuilderInterface
{
    /**
     * Change the default http client.
     *
     * @param HttpClientInterface $httpClient
     * @return self
     */
    public function withHttpClient(HttpClientInterface $httpClient): self;

    /**
     * Build a client with credentials
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @return ClientInterface
     */
    public function buildByCredentials(string $clientId, string $clientSecret, string $redirectUri): ClientInterface;

    /**
     * Build a client with credentials + tokens
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param string $accessToken
     * @param string $refreshToken
     * @param string|null $authorizationCode
     * @param integer|null $expirationTime
     * @return ClientInterface
     */
    public function buildByTokens(
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        string $accessToken,
        string $refreshToken,
        string $authorizationCode = null,
        int $expirationTime = null
    ): ClientInterface;

    /**
     * Build a client from an authentication object
     *
     * @param AuthenticationInterface $authentication
     * @return ClientInterface
     */
    public function buildAuthenticated(AuthenticationInterface $authentication): ClientInterface;
}
