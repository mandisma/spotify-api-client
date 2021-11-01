<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\PlaylistApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PlaylistApiTest extends ApiTestCase
{
    public function testAddItem()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $playlistId = '7oi0w0SLbJ4YyjrOxhZbUv';

        $added = $this->client->playlistApi->addItem($playlistId, [
            'uris' => 'spotify:track:4iV5W9uYEdYUVa79Axb7Rh, spotify:track:1301WleyT98MSxVHPZCA6M,spotify:episode:512ojhOuo1ktJprKbVcKyQ',
        ]);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($added);
    }

    public function testChangeDetails()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('search')));

        $playlistId = '6Df19VKaShrdWrAnHinwVO';

        $changed = $this->client->playlistApi->changeDetails($playlistId, [
            'name' => 'Playlist Name',
            'public' => true,
        ]);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(true, $changed);
    }

    public function testCreate()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist')));

        $userId = 'thelinmichael';
        $playlistName = 'New Playlist';

        $createdPlaylist = $this->client->playlistApi->create($userId, $playlistName, ['public' => true]);

        $requestUri = "/v1/users/${userId}/playlists";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['public' => true, 'name' => $playlistName], $this->lastRequestJson());
        $this->assertNotEmpty($createdPlaylist);
    }

    public function testGetCurrentUserPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $playlists = $this->client->playlistApi->getCurrentUserPlaylists();

        $requestUri = "/v1/me/playlists";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playlists['items']);
    }

    public function testGetUserPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $userId = 'user001';

        $playlists = $this->client->playlistApi->getUserPlaylists($userId);

        $requestUri = "/v1/users/${userId}/playlists";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playlists['items']);
    }

    public function testGetPlaylist()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist')));

        $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

        $playlist = $this->client->playlistApi->getPlaylist($playlistId);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playlist['id']);
    }

    public function testGetCoverImage()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('cover')));

        $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

        $cover = $this->client->playlistApi->getCoverImage($playlistId);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/images";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($cover);
    }

    public function testGetItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlist-items')));

        $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

        $items = $this->client->playlistApi->getItems($playlistId);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($items['items']);
    }

    public function testRemoveItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $tracks = [
            ["uri" => "spotify:track:4iV5W9uYEdYUVa79Axb7Rh"],
            ["uri" => "spotify:track:1301WleyT98MSxVHPZCA6M"],
            ["uri" => "spotify:episode:512ojhOuo1ktJprKbVcKyQ"],
        ];

        $playlistId = '71m0QB5fUFrnqfnxVerUup';

        $removed = $this->client->playlistApi->removeItems($playlistId, $tracks, ['snapshot' => 'snapshot']);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['snapshot' => 'snapshot', 'tracks' => $tracks], $this->lastRequestJson());
        $this->assertNotEmpty($removed);
    }

    public function testReorderItems()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('snapshot')));

        $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

        $reordered = $this->client->playlistApi->reorderItems($playlistId, 0, 4, ['snapshot' => 'snapshot']);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['snapshot' => 'snapshot', 'range_start' => 0, 'insert_before' => 4], $this->lastRequestJson());
        $this->assertNotEmpty($reordered);
    }

    public function testReplaceItems()
    {
        $this->mockHandler->append(new Response(200, []));

        $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

        $replaced = $this->client->playlistApi->replaceItems($playlistId);

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(true, $replaced);
    }

    public function testuploadCover()
    {
        $this->mockHandler->append(new Response(200, []));

        $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

        $uploaded = $this->client->playlistApi->uploadCover($playlistId, base64_encode('cover'));

        $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/images";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(true, $uploaded);
    }
}
