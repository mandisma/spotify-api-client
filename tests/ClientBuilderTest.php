<?php

namespace Mandisma\SpotifyApiClient\Tests;

use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ClientBuilderTest extends TestCase
{
    public function testbuildAuthenticated()
    {
        $authorization = $this->getMockBuilder(AuthorizationInterface::class)->getMock();

        $client = (new ClientBuilder())->build($authorization);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testDefaultHttpClient()
    {
        $clientBuilder = new ClientBuilder();

        $reflectionClass = new ReflectionClass($clientBuilder);
        $reflectionProperty = $reflectionClass->getProperty('httpClient');
        $reflectionProperty->setAccessible(true);
        $httpClient = $reflectionProperty->getValue(new ClientBuilder());

        $this->assertEquals(Client::API_URL, $httpClient->getConfig('base_uri'));
        $this->assertEquals(false, $httpClient->getConfig('http_errors'));
        $this->assertEquals(
            [
                'Accept' => 'application/json',
                'User-Agent' => 'GuzzleHttp/7',
            ],
            $httpClient->getConfig('headers')
        );
    }
}
