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

it('can get current user saved shows', function () {
    mockHandler()->append(new Response(200, [], load_fixture('shows')));

    $shows = client()->showApi->getCurrentUserSavedShows();

    $requestUri = '/v1/me/shows';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($shows)->not->toBeEmpty();
});

it('can check current user saved shows', function () {
    mockHandler()->append(new Response(200, [], load_fixture('shows')));

    $showsIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $shows = client()->showApi->checkCurrentUserSavedShows($showsIds);

    $requestUri = '/v1/me/shows/contains?' . http_build_query(['ids' => $showsIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($shows)->not->toBeEmpty();
});

it('can remove current user saved shows', function () {
    mockHandler()->append(new Response(200, []));

    $showsIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $removed = client()->showApi->removeCurrentUserSavedShows($showsIds, ['market' => 'FR']);

    $requestUri = '/v1/me/shows';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $showsIds, 'market' => 'FR']);
    expect($removed)->toBeTrue();
});

it('can save current user saved shows', function () {
    mockHandler()->append(new Response(200, []));

    $showsIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $saved = client()->showApi->saveCurrentUserShows($showsIds);

    $requestUri = '/v1/me/shows';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $showsIds]);
    expect($saved)->toBeTrue();
});
