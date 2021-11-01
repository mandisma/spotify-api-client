<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class ShowApiTest extends ApiTestCase
{
    public function testGetShow()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('show')));

        $showId = '38bS44xjbVVZ3No3ByF1dJ';

        $show = $this->client->showApi->getShow($showId);

        $requestUri = ShowApi::SHOW_URI . "/${showId}";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($show['id']);
    }

    public function testGetShows()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('shows')));

        $showIds = ['5CfCWKI5pZ28U0uOzXkDHe', '5as3aKmN2k11yfDDDSrvaZ'];

        $shows = $this->client->showApi->getShows($showIds, ['market' => 'FR']);

        $requestUri = ShowApi::SHOW_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $showIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($shows['shows']);
    }

    public function testGetShowEpisodes()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('show-episodes')));

        $showId = '38bS44xjbVVZ3No3ByF1dJ';

        $episodes = $this->client->showApi->getShowEpisodes($showId);

        $requestUri = ShowApi::SHOW_URI . "/${showId}/episodes";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($episodes['items']);
    }
}
