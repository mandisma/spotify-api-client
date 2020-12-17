<?php

namespace Mandisma\SpotifyApiClient\Tests;

use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\Authentication;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    public function testbuildAuthenticated()
    {
        $authentication = new Authentication(
            'client_id',
            'client_secret',
            'redirect_uri',
            'access_token',
            'refresh_token'
        );

        $client = (new ClientBuilder($authentication))->build();

        $this->assertInstanceOf(Client::class, $client);
    }
}
