<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class SearchApiTest extends ApiTestCase
{
    public function testSearchArtists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('search')));

        $search = $this->client->searchApi->search('tania bowra', 'artist', ['market' => 'FR']);

        $requestUri = "/v1/search?" . http_build_query([
            'market' => 'FR',
            'q' => 'tania bowra',
            'type' => 'artist',
        ], '', '&', PHP_QUERY_RFC3986);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($search['artists']);
    }
}
