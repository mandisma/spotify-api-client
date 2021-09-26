<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;

class SearchApiTest extends ApiTestCase
{
    public function testSearchArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('search')));

        $search = $this->client->searchApi->search('tania bowra', 'artist');

        $this->assertNotEmpty($search['artists']);
    }
}
