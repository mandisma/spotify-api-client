<?php

namespace Mandisma\SpotifyApiClient\Tests;

use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    public function testbuildAuthenticated()
    {
        $authorization = $this->getMockBuilder(AuthorizationInterface::class)->getMock();

        $client = (new ClientBuilder($authorization))->build();

        $this->assertInstanceOf(Client::class, $client);
    }
}
