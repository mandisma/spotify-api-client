<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class LibraryApiTest extends ApiTestCase
{
    public function testRemoveCurrentUserSavedAlbums()
    {
        $this->mockHandler->append(new Response(200, []));

        $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

        $removed = $this->client->libraryApi->removeCurrentUserSavedAlbums($albumsIds);

        $requestUri = '/v1/me/albums';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['ids' => $albumsIds], $this->lastRequestJson());
        $this->assertTrue($removed);
    }

    public function testGetCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->libraryApi->getCurrentUserSavedTracks();

        $requestUri = '/v1/me/tracks';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($tracks);
    }

    public function testGetCurrentUserSavedAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $albums = $this->client->libraryApi->getCurrentUserSavedAlbums();

        $requestUri = '/v1/me/albums';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($albums);
    }

    public function testSaveCurrentUserAlbums()
    {
        $this->mockHandler->append(new Response(200, []));

        $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

        $saved = $this->client->libraryApi->saveCurrentUserAlbums($albumsIds);

        $requestUri = '/v1/me/albums';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['ids' => $albumsIds], $this->lastRequestJson());
        $this->assertTrue($saved);
    }

    public function testSaveCurrentUserTracks()
    {
        $this->mockHandler->append(new Response(200, []));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $saved = $this->client->libraryApi->saveCurrentUserTracks($tracksIds);

        $requestUri = '/v1/me/tracks';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['ids' => $tracksIds], $this->lastRequestJson());
        $this->assertTrue($saved);
    }

    public function testCheckCurrentUserSavedAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

        $albums = $this->client->libraryApi->checkCurrentUserSavedAlbums($albumsIds);

        $requestUri = '/v1/me/albums/contains?' . http_build_query(['ids' => $albumsIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($albums);
    }

    public function testRemoveCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, []));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $removed = $this->client->libraryApi->removeCurrentUserSavedTracks($tracksIds);

        $requestUri = '/v1/me/tracks';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['ids' => $tracksIds], $this->lastRequestJson());
        $this->assertTrue($removed);
    }

    public function testCheckCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $tracks = $this->client->libraryApi->checkCurrentUserSavedTracks($tracksIds);

        $requestUri = '/v1/me/tracks/contains?' . http_build_query(['ids' => $tracksIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($tracks);
    }
}
