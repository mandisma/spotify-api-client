<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PersonalizationApiTest extends ApiTestCase
{
    public function testGetUserTopTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->personalizationApi->getCurrentUserTopTracks();

        $requestUri = '/v1/me/top/tracks';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($tracks);
    }

    public function testGetUserTopArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('artists')));

        $artists = $this->client->personalizationApi->getCurrentUserTopArtists();

        $requestUri = '/v1/me/top/artists';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($artists);
    }
}
