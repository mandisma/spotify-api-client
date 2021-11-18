<?php

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

abstract class ApiTestCase extends TestCase
{
    /**
     * @var MockHandler
     */
    protected $mockHandler;

    /**
     * @var array
     */
    protected $container = [];

    /**
     * @var GuzzleHttpClient
     */
    protected $httpClient;

    /**
     * @var Client
     */
    protected $client;

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getMockHandler(): MockHandler
    {
        return $this->mockHandler;
    }

    public function getContainer(): array
    {
        return $this->container;
    }

    public function getLastRequest(): Request
    {
        return $this->mockHandler->getLastRequest();
    }

    public function getLastRequestBody(): StreamInterface
    {
        return $this->getLastRequest()->getBody();
    }

    public function getAuthorization()
    {
        return $this->getMockBuilder(AuthorizationInterface::class)->getMock();
    }

    public function getHttpClient(): GuzzleHttpClient
    {
        return $this->httpClient;
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $history = Middleware::history($this->container);

        $this->mockHandler = new MockHandler();

        $handler = HandlerStack::create($this->mockHandler);

        $handler->push($history);

        $this->httpClient = new GuzzleHttpClient([
            'handler' => $handler,
        ]);

        $authorization = $this->getAuthorization();

        $this->client = $this->buildClient($authorization);
    }

    protected function buildClient(AuthorizationInterface $authorization)
    {
        return (new ClientBuilder($this->httpClient))
            ->build($authorization);
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
