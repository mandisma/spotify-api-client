<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PersonalizationApiTest extends ApiTestCase
{
    public function testGetUserTopTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->getPersonalizationApi()->getCurrentUserTopTracks();
        $this->assertNotEmpty($tracks);
    }

    public function testGetUserTopArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artists = $this->client->getPersonalizationApi()->getCurrentUserTopArtists();
        $this->assertNotEmpty($artists);
    }
}
