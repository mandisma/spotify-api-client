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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

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

        $this->client = $this->getClient($authorization);
    }

    protected function getAuthorization()
    {
        return $this->getMockBuilder(AuthorizationInterface::class)->getMock();
    }

    protected function getClient(AuthorizationInterface $authorization)
    {
        return (new ClientBuilder($this->httpClient))
            ->build($authorization);
    }

    protected function getLastRequest(): Request
    {
        return $this->mockHandler->getLastRequest();
    }

    protected function getLastRequestUri(): UriInterface
    {
        return $this->getLastRequest()->getUri();
    }

    protected function getLastRequestBody(): StreamInterface
    {
        return $this->getLastRequest()->getBody();
    }

    protected function lastRequestJson(): array
    {
        return json_decode($this->getLastRequestBody()->getContents(), true);
    }

    protected function getLastResponse(): ResponseInterface
    {
        return end($this->container)['response'];
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
