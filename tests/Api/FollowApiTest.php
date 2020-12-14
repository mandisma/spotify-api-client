<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class FollowApiTest extends ApiTestCase
{
    public function testIsFollowingUsers()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $usersIds = ['exampleuser01'];

        $followed = $this->client->getFollowApi()->isFollowingUsers($usersIds);

        $this->assertContains(true, $followed);
    }

    public function testIsFollowingArtists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([false])));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->getFollowApi()->isFollowingArtists($artistsIds);

        $this->assertContains(false, $followed);
    }

    public function testFollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $followed = $this->client->getFollowApi()->followUsers($usersIds);

        $this->assertTrue($followed);
    }

    public function testFollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->getFollowApi()->followArtists($artistsIds);

        $this->assertTrue($followed);
    }

    public function testIsFollowingPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';
        $usersIds = ['exampleuser01'];

        $followed = $this->client->getFollowApi()->isFollowingPlaylists($playlistId, $usersIds);

        $this->assertContains(true, $followed);
    }

    public function testFollowPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $followed = $this->client->getFollowApi()->followPlaylists($playlistId);

        $this->assertTrue($followed);
    }

    public function testGetUserFollowedArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artists = $this->client->getFollowApi()->getCurrentUserFollowedArtists('artist');

        $this->assertNotEmpty($artists);
    }

    public function testUnfollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $unfollowed = $this->client->getFollowApi()->unfollowArtists($artistsIds);

        $this->assertTrue($unfollowed);
    }

    public function testUnfollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $unfollowed = $this->client->getFollowApi()->unfollowUsers($usersIds);

        $this->assertTrue($unfollowed);
    }

    public function testUnfollowPlaylist()
    {
        $this->mockHandler->append(new Response(204, []));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $unfollowed = $this->client->getFollowApi()->unfollowPlaylist($playlistId);

        $this->assertTrue($unfollowed);
    }
}
