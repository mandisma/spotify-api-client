<?php

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;
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

        $authorization = $this->getAuthorization();

        $this->client = $this->getClient($authorization);
    }

    protected function getAuthorization()
    {
        return $this->getMockBuilder(AuthorizationInterface::class)->getMock();
    }

    protected function getClient(AuthorizationInterface $authorization)
    {
        return (new ClientBuilder($authorization))
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
