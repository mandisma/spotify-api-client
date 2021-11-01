<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\FollowApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class FollowApiTest extends ApiTestCase
{
    public function testIsFollowingUsers()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $usersIds = ['exampleuser01'];

        $followed = $this->client->followApi->isFollowingUsers($usersIds);

        $requestUri = '/v1/me/following/contains?' . http_build_query([
            'type' => FollowApi::TYPE_USER,
            'ids' => $usersIds,
        ]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertContains(true, $followed);
    }

    public function testIsFollowingArtists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([false])));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->followApi->isFollowingArtists($artistsIds);

        $requestUri = '/v1/me/following/contains?' . http_build_query([
            'type' => FollowApi::TYPE_ARTIST,
            'ids' => $artistsIds,
        ]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertContains(false, $followed);
    }

    public function testFollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $followed = $this->client->followApi->followUsers($usersIds);

        $requestUri = '/v1/me/following';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['type' => 'user', 'ids' => ['exampleuser01']], $this->lastRequestJson());
        $this->assertTrue($followed);
    }

    public function testFollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->followApi->followArtists($artistsIds);

        $requestUri = '/v1/me/following';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['type' => 'artist', 'ids' => ['74ASZWbe4lXaubB36ztrGX']], $this->lastRequestJson());
        $this->assertTrue($followed);
    }

    public function testIsFollowingPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';
        $usersIds = ['exampleuser01'];

        $followed = $this->client->followApi->isFollowingPlaylists($playlistId, $usersIds);

        $requestUri = '/v1/playlists/' . $playlistId . '/followers/contains?' . http_build_query([
            'ids' => $usersIds,
        ]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertContains(true, $followed);
    }

    public function testFollowPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $followed = $this->client->followApi->followPlaylists($playlistId);

        $requestUri = '/v1/playlists/' . $playlistId . '/followers';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($followed);
    }

    public function testGetUserFollowedArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artists = $this->client->followApi->getCurrentUserFollowedArtists('artist', ['limit' => 5]);

        $requestUri = '/v1/me/following?' . http_build_query(['limit' => 5, 'type' => 'artist']);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($artists);
    }

    public function testUnfollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $unfollowed = $this->client->followApi->unfollowArtists($artistsIds);

        $requestUri = '/v1/me/following';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['type' => 'artist', 'ids' => $artistsIds], $this->lastRequestJson());
        $this->assertTrue($unfollowed);
    }

    public function testUnfollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $unfollowed = $this->client->followApi->unfollowUsers($usersIds);

        $requestUri = '/v1/me/following';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['type' => 'user', 'ids' => $usersIds], $this->lastRequestJson());
        $this->assertTrue($unfollowed);
    }

    public function testUnfollowPlaylist()
    {
        $this->mockHandler->append(new Response(204, []));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $unfollowed = $this->client->followApi->unfollowPlaylist($playlistId);

        $requestUri = '/v1/playlists/' . $playlistId . '/followers';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($unfollowed);
    }
}
