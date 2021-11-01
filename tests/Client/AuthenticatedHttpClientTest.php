<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Client;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Exception\ResponseException;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AuthenticatedHttpClientTest extends ApiTestCase
{
    private $authenticatedHttpClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $this->getAuthorization());
    }

    public function testRequestHasAuthorization(): void
    {
        $this->mockHandler->append(new Response(200, [], json_encode(['foo' => 'bar'])));

        $this->authenticatedHttpClient->get('test');

        $this->assertTrue($this->mockHandler->getLastRequest()->hasHeader('Authorization'));
        $this->assertEquals(200, $this->getLastResponse()->getStatusCode());
    }

    public function testGet(): void
    {
        $this->mockHandler->append(new Response(201, [], json_encode(['foo' => 'bar'])));

        $data = $this->authenticatedHttpClient->get('test');

        $this->assertIsArray($data);
        $this->assertArrayHasKey('foo', $data);
        $this->assertEquals(201, $this->getLastResponse()->getStatusCode());
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

    public function testResponseException(): void
    {
        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Test error');

        $this->mockHandler->append(new Response(208, [], 'Test error'));

        $this->authenticatedHttpClient->get('test-error');
    }
}
