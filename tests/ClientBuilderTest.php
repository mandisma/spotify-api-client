<?php

namespace Mandisma\SpotifyApiClient\Tests;

use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    /**
     * @var ClientBuilder
     */
    private $clientBuilder;

    protected function setUp()
    {
        $this->clientBuilder = new ClientBuilder();
    }

    public function testBuildByCredentials()
    {
        $client = $this->clientBuilder->buildByCredentials(
            'client_id',
            'client_secret',
            'redirect_uri'
        );

        $this->assertInstanceOf(Client::class, $client);
    }

    public function buildByTokens()
    {
        $client = $this->clientBuilder->buildByTokens(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );

        $this->assertInstanceOf(Client::class, $client);
    }
}
