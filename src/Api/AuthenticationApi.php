<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Mandisma\SpotifyApiClient\Security\Authentication;

final class AuthenticationApi
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
     * @var Authentication
     */
    private $authentication;

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient, Authentication $authentication)
    {
        $this->httpClient = $httpClient;
        $this->authentication = $authentication;
    }

    /**
     * Run an authentication request
     *
     * @param array $payload
     * @return array
     */
    private function auth(array $payload = []): array
    {
        $uri = self::ACCOUNT_URL . '/api/token';
        $token = base64_encode($this->authentication->getClientId() . ':' . $this->authentication->getClientSecret());

        $payload[RequestOptions::FORM_PARAMS] = $payload;
        $payload['headers'] = [
            'Authorization' => sprintf('Basic %s', $token),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $response =  $this->httpClient->request('POST', $uri, $payload);

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true);
    }

    /**
     * Request an access token using the Client Credentials Flow.
     *
     * @return Authentication
     */
    public function requestCredentialsToken(): Authentication
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
     * Request an access token using the Authorization Code Flow
     *
     * @param string|null $code The Authorization Code
     * @return Authentication
     */
    public function requestAccessToken(string $code = null): Authentication
    {
        if (is_null($code)) {
            $code = $this->authentication->getAuthorizationCode();
        }

        if (is_null($code)) {
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
     * Refresh the access token
     *
     * @return Authentication
     */
    public function refreshAccessToken(): Authentication
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
     * Request an user authorization code
     *
     * @param array $scopes
     *
     * @return void
     */
    public function requestAuthorizationCode(array $scopes): void
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
        exit;
    }

    /**
     * Get the authentication class
     *
     * @return Authentication
     */
    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }
}
