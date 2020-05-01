<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\Api\ApiTestCase;

class ArtistApiTest extends ApiTestCase
{
    public function testGetArtistRelatedArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $artists = $this->client->getArtistApi()->getRelatedArtists($artistId);

        $this->assertNotEmpty($artists);
    }

    public function testGetArtistAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $albums = $this->client->getArtistApi()->getAlbums($artistId);

        $this->assertNotEmpty($albums);
    }

    public function testGetArtist()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artist')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $artist = $this->client->getArtistApi()->getArtist($artistId);

        $this->assertNotEmpty($artist);
    }

    public function testGetArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $artistsIds = ['0oSGxfWSnnOXhD2fKuz2Gy', '3dBVyJ7JuOMt4GE9607Qin'];

        $artists = $this->client->getArtistApi()->getArtists($artistsIds);

        $this->assertNotEmpty($artists);
    }

    public function testGetArtistTopTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $tracks = $this->client->getArtistApi()->getTopTracks($artistId, 'FR');

        $this->assertNotEmpty($tracks);
    }
}
