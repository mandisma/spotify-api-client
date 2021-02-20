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

        $this->assertTrue($removed);
    }

    public function testGetCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->libraryApi->getCurrentUserSavedTracks();

        $this->assertNotEmpty($tracks);
    }

    public function testGetCurrentUserSavedAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $albums = $this->client->libraryApi->getCurrentUserSavedAlbums();

        $this->assertNotEmpty($albums);
    }

    public function testSaveCurrentUserAlbums()
    {
        $this->mockHandler->append(new Response(200, []));

        $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

        $saved = $this->client->libraryApi->saveCurrentUserAlbums($albumsIds);

        $this->assertTrue($saved);
    }

    public function testSaveCurrentUserTracks()
    {
        $this->mockHandler->append(new Response(200, []));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $saved = $this->client->libraryApi->saveCurrentUserTracks($tracksIds);

        $this->assertTrue($saved);
    }

    public function testCheckCurrentUserSavedAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

        $albums = $this->client->libraryApi->checkCurrentUserSavedAlbums($albumsIds);

        $this->assertNotEmpty($albums);
    }

    public function testRemoveCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, []));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $removed = $this->client->libraryApi->removeCurrentUserSavedTracks($tracksIds);

        $this->assertTrue($removed);
    }

    public function testCheckCurrentUserSavedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

        $tracks = $this->client->libraryApi->checkCurrentUserSavedTracks($tracksIds);

        $this->assertNotEmpty($tracks);
    }
}
