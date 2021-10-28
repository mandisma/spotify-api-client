<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class ShowApiTest extends ApiTestCase
{
    public function testGetShow()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('show')));

        $show = $this->client->showApi->getShow('38bS44xjbVVZ3No3ByF1dJ');

        $this->assertNotEmpty($show['id']);
    }

    public function testGetShows()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('shows')));

        $shows = $this->client->showApi->getShows(['5CfCWKI5pZ28U0uOzXkDHe', '5as3aKmN2k11yfDDDSrvaZ']);

        $this->assertNotEmpty($shows['shows']);
    }

    public function testGetShowEpisodes()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('show-episodes')));

        $episodes = $this->client->showApi->getShowEpisodes('38bS44xjbVVZ3No3ByF1dJ');

        $this->assertNotEmpty($episodes['items']);
    }
}
