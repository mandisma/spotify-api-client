<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Client;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AuthenticatedHttpClientTest extends ApiTestCase
{
    private $authenticatedHttpClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $this->getAuthorization());
    }

    public function testGet(): void
    {
        $this->mockHandler->append(new Response(200, [], json_encode(['foo' => 'bar'])));

        $data = $this->authenticatedHttpClient->get('test');

        $this->assertIsArray($data);
        $this->assertArrayHasKey('foo', $data);
    }

    public function testPost(): void
    {
        $this->mockHandler->append(new Response(200, [], json_encode(['foo' => 'bar'])));

        $data = $this->authenticatedHttpClient->post('test');

        $this->assertIsArray($data);
        $this->assertArrayHasKey('foo', $data);
    }

    public function testPut(): void
    {
        $this->mockHandler->append(new Response(200));

        $data = $this->authenticatedHttpClient->put('test');

        $this->assertIsString($data);
        $this->assertEmpty($data);
    }

    public function testDelete(): void
    {
        $this->mockHandler->append(new Response(200));

        $data = $this->authenticatedHttpClient->delete('test');

        $this->assertIsString($data);
        $this->assertEmpty($data);
    }
}
