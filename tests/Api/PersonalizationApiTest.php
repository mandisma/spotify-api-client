<?php

use GuzzleHttp\Psr7\Response;

it('can get user top tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracks = client()->personalizationApi->getCurrentUserTopTracks();

    $requestUri = '/v1/me/top/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can get user top artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artists')));

    $artists = client()->personalizationApi->getCurrentUserTopArtists();

    $requestUri = '/v1/me/top/artists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});
