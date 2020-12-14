<?php

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
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
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        $this->mockHandler = new MockHandler();

        $this->httpClient = new GuzzleHttpClient([
            'handler' => $this->mockHandler,
        ]);

        $clientBuilder = new ClientBuilder($this->httpClient);
        $this->client = $clientBuilder->buildByTokens(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->mockHandler = null;
        $this->httpClient = null;
        $this->client = null;
    }
}
