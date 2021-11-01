<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class EpisodeApiTest extends ApiTestCase
{
    public function testGetEpisodes()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('episodes')));

        $episodesIds = ['77o6BIVlYM3msb4MMIL1jH', '0Q86acNRm6V9GYx55SXKwf'];

        $episodes = $this->client->episodeApi->getEpisodes($episodesIds, ['market' => 'FR']);

        $requestUri = EpisodeApi::EPISODE_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $episodesIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($episodes);
    }

    public function testGetEpisode()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('episode')));

        $episodeId = '512ojhOuo1ktJprKbVcKyQ';

        $episode = $this->client->episodeApi->getEpisode($episodeId);

        $requestUri = EpisodeApi::EPISODE_URI . '/' . $episodeId;

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($episode);
    }
}
