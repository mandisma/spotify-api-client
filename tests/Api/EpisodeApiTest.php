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

it('can get current user saved episodes', function () {
    mockHandler()->append(new Response(200, [], load_fixture('episodes')));

    $episodes = client()->episodeApi->getCurrentUserSavedEpisodes();

    $requestUri = '/v1/me/episodes';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($episodes)->not->toBeEmpty();
});

it('can check current user saved episodes', function () {
    mockHandler()->append(new Response(200, [], load_fixture('episodes')));

    $episodesIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $episodes = client()->episodeApi->checkCurrentUserSavedEpisodes($episodesIds);

    $requestUri = '/v1/me/episodes/contains?' . http_build_query(['ids' => $episodesIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($episodes)->not->toBeEmpty();
});

it('can remove current user saved episodes', function () {
    mockHandler()->append(new Response(200, []));

    $episodesIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $removed = client()->episodeApi->removeCurrentUserSavedEpisodes($episodesIds);

    $requestUri = '/v1/me/episodes';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $episodesIds]);
    expect($removed)->toBeTrue();
});

it('can save current user saved episodes', function () {
    mockHandler()->append(new Response(200, []));

    $episodesIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $saved = client()->episodeApi->saveCurrentUserEpisodes($episodesIds);

    $requestUri = '/v1/me/episodes';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $episodesIds]);
    expect($saved)->toBeTrue();
});
