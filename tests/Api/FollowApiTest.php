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

        $followed = $this->client->followApi->isFollowingUsers($usersIds);

        $this->assertContains(true, $followed);
    }

    public function testIsFollowingArtists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([false])));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->followApi->isFollowingArtists($artistsIds);

        $this->assertContains(false, $followed);
    }

    public function testFollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $followed = $this->client->followApi->followUsers($usersIds);

        $this->assertTrue($followed);
    }

    public function testFollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $followed = $this->client->followApi->followArtists($artistsIds);

        $this->assertTrue($followed);
    }

    public function testIsFollowingPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';
        $usersIds = ['exampleuser01'];

        $followed = $this->client->followApi->isFollowingPlaylists($playlistId, $usersIds);

        $this->assertContains(true, $followed);
    }

    public function testFollowPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], json_encode([true])));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $followed = $this->client->followApi->followPlaylists($playlistId);

        $this->assertTrue($followed);
    }

    public function testGetUserFollowedArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artists = $this->client->followApi->getCurrentUserFollowedArtists('artist');

        $this->assertNotEmpty($artists);
    }

    public function testUnfollowArtists()
    {
        $this->mockHandler->append(new Response(204, []));

        $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

        $unfollowed = $this->client->followApi->unfollowArtists($artistsIds);

        $this->assertTrue($unfollowed);
    }

    public function testUnfollowUsers()
    {
        $this->mockHandler->append(new Response(204, []));

        $usersIds = ['exampleuser01'];

        $unfollowed = $this->client->followApi->unfollowUsers($usersIds);

        $this->assertTrue($unfollowed);
    }

    public function testUnfollowPlaylist()
    {
        $this->mockHandler->append(new Response(204, []));

        $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

        $unfollowed = $this->client->followApi->unfollowPlaylist($playlistId);

        $this->assertTrue($unfollowed);
    }
}
