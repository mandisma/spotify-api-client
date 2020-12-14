<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;

final class AuthenticationApi implements AuthenticationApiInterface
{
    /**
     * The Spotify Account URI
     *
     * @var string
     */
    public const ACCOUNT_URL = 'https://accounts.spotify.com';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient, AuthenticationInterface $authentication)
    {
        $this->httpClient = $httpClient;
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
        $token = base64_encode($this->authentication->getClientId() . ':' . $this->authentication->getClientSecret());

        $payload[RequestOptions::FORM_PARAMS] = $parameters;

        $payload['headers'] = [
            'Authorization' => sprintf('Basic %s', $token),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $response =  $this->httpClient->request('POST', $uri, $payload);

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true);
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
    public function requestAccessToken(string $code = null): AuthenticationInterface
    {
        if (is_null($code)) {
            $code = $this->authentication->getAuthorizationCode();
        }

        if (is_null($code)) {
            // TODO: Use a custom exception
            throw new Exception("Authorization missing. Request Aborted", 1);
        }

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
    public function refreshAccessToken(): AuthenticationInterface
    {
        $refreshToken = $this->authentication->getRefreshToken();

        if (is_null($refreshToken)) {
            throw new Exception("Refresh token missing. Request aborted.", 1);
        }

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
