<?php

namespace Mandisma\SpotifyApiClient\Tests;

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
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->mockHandler = new MockHandler();

        $this->httpClient = new GuzzleHttpClient([
            'handler' => $this->mockHandler,
        ]);

        $clientBuilder = new ClientBuilder();
        $this->client = $clientBuilder->withHttpClient($this->httpClient)->buildByTokens(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );
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
