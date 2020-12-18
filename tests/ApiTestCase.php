<?php

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\Authentication;
use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;
use PHPUnit\Framework\TestCase;

abstract class ApiTestCase extends TestCase
{
    /**
     * @var MockHandler
     */
    protected $mockHandler;

    /**
     * @var GuzzleHttpClient
     */
    protected $httpClient;

    /**
     * @var Client
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->mockHandler = new MockHandler();

        $this->httpClient = new GuzzleHttpClient([
            'handler' => $this->mockHandler,
        ]);

        $authentication = new Authentication(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );

        $this->client = $this->getClient($authentication);
    }

    protected function getClient(AuthenticationInterface $authentication)
    {
        return (new ClientBuilder($authentication))
            ->withHttpClient($this->httpClient)
            ->build();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->mockHandler = null;
        $this->httpClient = null;
        $this->client = null;
    }
}
