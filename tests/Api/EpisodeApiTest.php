<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;

it('can get episodes', function () {
    mockHandler()->append(new Response(200, [], load_fixture('episodes')));

    $episodesIds = ['77o6BIVlYM3msb4MMIL1jH', '0Q86acNRm6V9GYx55SXKwf'];

    $episodes = client()->episodeApi->getEpisodes($episodesIds, ['market' => 'FR']);

    $requestUri = EpisodeApi::EPISODE_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $episodesIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($episodes)->not->toBeEmpty();
});

it('can get episode', function () {
    mockHandler()->append(new Response(200, [], load_fixture('episode')));

    $episodeId = '512ojhOuo1ktJprKbVcKyQ';

    $episode = client()->episodeApi->getEpisode($episodeId);

    $requestUri = EpisodeApi::EPISODE_URI . '/' . $episodeId;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($episode)->not->toBeEmpty();
});
