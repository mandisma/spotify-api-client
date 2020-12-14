<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Client;

use GuzzleHttp\ClientInterface;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Psr\Http\Message\ResponseInterface;

final class AuthenticatedHttpClient implements AuthenticatedHttpClientInterface
{
    /**
     * @var ClientInterface
     */
    private $baseHttpClient;

    /**
     * @var AuthenticationApi
     */
    private $authenticationApi;

    /**
     * @param ClientInterface $baseHttpClient
     * @param AuthenticationApi $authenticationApi
     */
    public function __construct(
        ClientInterface $baseHttpClient,
        AuthenticationApi $authenticationApi
    ) {
        $this->baseHttpClient = $baseHttpClient;
        $this->authenticationApi = $authenticationApi;
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $method, string $uri = '', array $options = []): ResponseInterface
    {
        $authentication = $this->authenticationApi->getAuthentication();
        // If no access token provided, authenticate with credentials
        if ($authentication->needAuthentication()) {
            $this->authenticate();
        }

        $headers = $options['headers'] ?? [];

        $options['headers'] = array_merge($headers, [
            'Authorization' => sprintf('Bearer %s', $authentication->getAccessToken()),
        ]);

        return $this->baseHttpClient->request($method, $uri, $options);
    }

    /**
     * Request for an access token from credentials
     *
     * @return void
     */
    private function authenticate(): void
    {
        $this->authenticationApi->requestCredentialsToken();
    }
}
