<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\ShowApi;

it('can get show', function () {
    mockHandler()->append(new Response(200, [], load_fixture('show')));

    $showId = '38bS44xjbVVZ3No3ByF1dJ';

    $show = client()->showApi->getShow($showId);

    $requestUri = ShowApi::SHOW_URI . "/${showId}";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($show['id'])->not->toBeEmpty();
});

it('can get shows', function () {
    mockHandler()->append(new Response(200, [], load_fixture('shows')));

    $showIds = ['5CfCWKI5pZ28U0uOzXkDHe', '5as3aKmN2k11yfDDDSrvaZ'];

    $shows = client()->showApi->getShows($showIds, ['market' => 'FR']);

    $requestUri = ShowApi::SHOW_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $showIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($shows['shows'])->not->toBeEmpty();
});

it('can get show episodes', function () {
    mockHandler()->append(new Response(200, [], load_fixture('show-episodes')));

    $showId = '38bS44xjbVVZ3No3ByF1dJ';

    $episodes = client()->showApi->getShowEpisodes($showId);

    $requestUri = ShowApi::SHOW_URI . "/${showId}/episodes";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($episodes['items'])->not->toBeEmpty();
});
