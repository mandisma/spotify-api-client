<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\HttpClientInterface;
use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;

final class AuthenticationApi extends AbstractApi implements AuthenticationApiInterface
{
    /**
     * The Spotify Account URI
     *
     * @var string
     */
    public const ACCOUNT_URL = 'https://accounts.spotify.com';

    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    /**
     * @param HttpClientInterface $resourceClient
     * @param AuthenticationInterface $authentication
     */
    public function __construct(HttpClientInterface $resourceClient, AuthenticationInterface $authentication)
    {
        parent::__construct($resourceClient);
        $this->authentication = $authentication;
    }

    /**
     * Run an authentication request
     *
     * @param array $parameters
     * @return array
     */
    private function auth(array $parameters = []): array
    {
        $uri = self::ACCOUNT_URL . '/api/token';
        return $this->resourceClient->auth($uri, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function requestCredentialsToken(): AuthenticationInterface
    {
        $parameters = [
            'grant_type' => 'client_credentials',
        ];

        $tokens = $this->auth($parameters);

        return $this->authentication
            ->setAccessToken($tokens['access_token'])
            ->setExpirationTime($tokens['expires_in']);
    }

    /**
     * {@inheritdoc}
     */
    public function requestAccessToken(string $code): AuthenticationInterface
    {
        $parameters = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->authentication->getRedirectUri(),
        ];

        $tokens = $this->auth($parameters);

        return $this->authentication
            ->setAccessToken($tokens['access_token'])
            ->setRefreshToken($tokens['refresh_token'])
            ->setExpirationTime($tokens['expires_in'])
            ->setAuthorizationCode($code);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshAccessToken(string $refreshToken): AuthenticationInterface
    {
        $parameters = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ];

        $tokens = $this->auth($parameters);

        return $this->authentication
            ->setAccessToken($tokens['access_token'])
            ->setExpirationTime($tokens['expires_in']);
    }

    /**
     * {@inheritdoc}
     */
    public function requestAuthorizationCode(array $scopes): bool
    {
        $authorizationUrl = self::ACCOUNT_URL . '/authorize';

        $params = [
            'client_id' => $this->authentication->getClientId(),
            'response_type' => 'code',
            'redirect_uri' => $this->authentication->getRedirectUri(),
            'scope' => implode(',', $scopes)
        ];

        $authorizationUrl .= '?' . http_build_query($params);

        // Redirect the user to the authorization URL.
        header('Location: ' . $authorizationUrl);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthentication(): AuthenticationInterface
    {
        return $this->authentication;
    }
}
