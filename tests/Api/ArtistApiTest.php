<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class ArtistApiTest extends ApiTestCase
{
    public function testGetArtistRelatedArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $artists = $this->client->artistApi->getRelatedArtists($artistId);

        $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/related-artists';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($artists);
    }

    public function testGetArtistAlbums()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $albums = $this->client->artistApi->getAlbums($artistId);

        $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/albums';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($albums);
    }

    public function testGetArtist()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artist')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $artist = $this->client->artistApi->getArtist($artistId);

        $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId;

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($artist);
    }

    public function testGetArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $artistsIds = ['0oSGxfWSnnOXhD2fKuz2Gy', '3dBVyJ7JuOMt4GE9607Qin'];

        $artists = $this->client->artistApi->getArtists($artistsIds);

        $requestUri = ArtistApi::ARTIST_URI . '?' . http_build_query(['ids' => $artistsIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($artists);
    }

    public function testGetArtistTopTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

        $tracks = $this->client->artistApi->getTopTracks($artistId, 'FR');

        $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/top-tracks?country=FR';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($tracks);
    }
}
