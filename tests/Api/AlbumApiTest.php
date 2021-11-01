<?php

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AlbumApiTest extends ApiTestCase
{
    protected $albumIds;

    protected function setUp(): void
    {
        parent::setUp();
        $this->albumIds = [
            '0sNOF9WDwhWunNAHPD3Baj',
            '41MnTivkwTO3UUJ8DrqEJJ',
            '6JWc4iAiJ9FjyK0B59ABb4',
            '6UXCm6bOO4gFlDQZV5yL37',
        ];
    }

    public function testGetAlbum()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('album')));

        $album = $this->client->albumApi->getAlbum($this->albumIds[0]);

        $requestUri = AlbumApi::ALBUM_URI . '/' . $this->albumIds[0];

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($album);
        $this->assertEquals($this->albumIds[0], $album['id']);
    }

    public function testGetAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('album')));

        $albums = $this->client->albumApi->getAlbums($this->albumIds, ['market' => 'FR']);

        $requestUri = AlbumApi::ALBUM_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $this->albumIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($albums);
    }

    public function testGetTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $response = $this->client->albumApi->getTracks($this->albumIds[0]);

        $requestUri = AlbumApi::ALBUM_URI . '/' . $this->albumIds[0] . '/tracks';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($response);
    }
}
