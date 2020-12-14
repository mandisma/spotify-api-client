<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PlaylistApiTest extends ApiTestCase
{
    public function testAddItem()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $added = $this->client->getPlaylistApi()->addItem('7oi0w0SLbJ4YyjrOxhZbUv', [
            'uris' => 'spotify:track:4iV5W9uYEdYUVa79Axb7Rh, spotify:track:1301WleyT98MSxVHPZCA6M,spotify:episode:512ojhOuo1ktJprKbVcKyQ'
        ]);

        $this->assertNotEmpty($added);
    }

    public function testChangeDetails()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('search')));

        $changed = $this->client->getPlaylistApi()->changeDetails('6Df19VKaShrdWrAnHinwVO', [
            'name' => 'Playlist Name',
            'public' => true
        ]);

        $this->assertEquals(true, $changed);
    }

    public function testCreate()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist')));

        $createdPlaylist = $this->client->getPlaylistApi()->create('thelinmichael', 'New Playlist');

        $this->assertNotEmpty($createdPlaylist);
    }

    public function testGetCurrentUserPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $playlists = $this->client->getPlaylistApi()->getCurrentUserPlaylists();

        $this->assertNotEmpty($playlists['items']);
    }

    public function testGetUserPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $userId = 'user001';

        $playlists = $this->client->getPlaylistApi()->getUserPlaylists($userId);

        $this->assertNotEmpty($playlists['items']);
    }

    public function testGetPlaylist()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist')));

        $playlist = $this->client->getPlaylistApi()->getPlaylist('59ZbFPES4DQwEjBpWHzrtC');

        $this->assertNotEmpty($playlist['id']);
    }

    public function testGetCoverImage()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('cover')));

        $cover = $this->client->getPlaylistApi()->getCoverImage('59ZbFPES4DQwEjBpWHzrtC');

        $this->assertNotEmpty($cover);
    }

    public function testGetItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist-items')));

        $items = $this->client->getPlaylistApi()->getItems('59ZbFPES4DQwEjBpWHzrtC');

        $this->assertNotEmpty($items['items']);
    }

    public function testRemoveItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $tracks = [
            ["uri" => "spotify:track:4iV5W9uYEdYUVa79Axb7Rh"],
            ["uri" => "spotify:track:1301WleyT98MSxVHPZCA6M"],
            ["uri" => "spotify:episode:512ojhOuo1ktJprKbVcKyQ"]
        ];

        $removed = $this->client->getPlaylistApi()->removeItems('71m0QB5fUFrnqfnxVerUup', $tracks);

        $this->assertNotEmpty($removed);
    }

    public function testReorderItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $reordered = $this->client->getPlaylistApi()->reorderItems('0vXtvEeftmc2aVQD9QBWrQ', 0, 4);

        $this->assertNotEmpty($reordered);
    }

    public function testReplaceItems()
    {
        $this->mockHandler->append(new Response(200, []));

        $replaced = $this->client->getPlaylistApi()->replaceItems('0vXtvEeftmc2aVQD9QBWrQ');

        $this->assertEquals(true, $replaced);
    }

    // public function testuploadCover()
    // {
    //     $this->mockHandler->append(new Response(200, []));

    //     $uploaded = $this->client->getPlaylistApi()->uploadCover('0vXtvEeftmc2aVQD9QBWrQ');

    //     $this->assertEquals(true, $uploaded);
    // }
}
