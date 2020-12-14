<?php

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class AlbumApiTest extends ApiTestCase
{
    protected $albumIds;

    public function setUp(): void
    {
        parent::setUp();
        $this->albumIds = [
            '0sNOF9WDwhWunNAHPD3Baj',
            '41MnTivkwTO3UUJ8DrqEJJ',
            '6JWc4iAiJ9FjyK0B59ABb4',
            '6UXCm6bOO4gFlDQZV5yL37'
        ];
    }

    public function testGetAlbum()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('album')));

        $album = $this->client->getAlbumApi()->getAlbum($this->albumIds[0]);

        $this->assertNotEmpty($album);
        $this->assertEquals($this->albumIds[0], $album['id']);
    }

    public function testGetAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('album')));

        $albums = $this->client->getAlbumApi()->getAlbums($this->albumIds);

        $this->assertNotEmpty($albums);
    }

    public function testGetTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $response = $this->client->getAlbumApi()->getTracks($this->albumIds[0]);

        $this->assertNotEmpty($response);
    }
}
