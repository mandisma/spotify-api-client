<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;

it('can get audio analysis', function () {
    mockHandler()->append(new Response(200, [], load_fixture('audio-analysis')));

    $trackId = '0eGsygTp906u18L0Oimnem';

    $audioAnalysis = client()->trackApi->getAudioAnalysis($trackId);

    $requestUri = "/v1/audio-analysis/${trackId}";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($audioAnalysis['track'])->not->toBeEmpty();
});

it('can get audio features for track', function () {
    mockHandler()->append(new Response(200, [], load_fixture('track-audio-features')));

    $trackId = '0eGsygTp906u18L0Oimnem';

    $audioFeatures = client()->trackApi->getAudioFeaturesForTrack($trackId);

    $requestUri = "/v1/audio-features/${trackId}";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($audioFeatures['id'])->not->toBeEmpty();
});

it('can get audio features for tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks-audio-features')));

    $trackIds = [
        '0eGsygTp906u18L0Oimnem',
        'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
    ];

    $audioFeatures = client()->trackApi->getAudioFeaturesForTracks($trackIds);

    $requestUri = "/v1/audio-features?" . http_build_query(['ids' => $trackIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($audioFeatures['audio_features'])->not->toBeEmpty();
});

it('can get tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $trackIds = [
        '0eGsygTp906u18L0Oimnem',
        'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
    ];

    $audioFeatures = client()->trackApi->getTracks($trackIds, ['market' => 'FR']);

    $requestUri = "/v1/tracks?" . http_build_query(['market' => 'FR', 'ids' => implode(',', $trackIds)]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($audioFeatures['tracks'])->not->toBeEmpty();
});

it('can get track', function () {
    mockHandler()->append(new Response(200, [], load_fixture('track')));

    $trackId = '0eGsygTp906u18L0Oimnem';

    $audioFeatures = client()->trackApi->getTrack($trackId);

    $requestUri = "/v1/tracks/$trackId";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($audioFeatures['id'])->not->toBeEmpty();
});

it('can remove current user saved tracks', function () {
    mockHandler()->append(new Response(200, []));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $removed = client()->trackApi->removeCurrentUserSavedTracks($tracksIds);

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $tracksIds]);
    expect($removed)->toBeTrue();
});

it('can check current user saved tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $tracks = client()->trackApi->checkCurrentUserSavedTracks($tracksIds);

    $requestUri = '/v1/me/tracks/contains?' . http_build_query(['ids' => $tracksIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can save current user tracks', function () {
    mockHandler()->append(new Response(200, []));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $saved = client()->trackApi->saveCurrentUserTracks($tracksIds);

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $tracksIds]);
    expect($saved)->toBeTrue();
});

it('can get current user saved tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracks = client()->trackApi->getCurrentUserSavedTracks();

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can get recommendations', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $recommendations = client()->trackApi->getRecommendations(
        ['4NHQUGzhtTLFvgF5SZesLK'],
        ['classical'],
        ['0c6xIDDpzE81m2q797ordA'],
        [
            'market' => 'FR',
        ]
    );

    $requestUri = '/v1/recommendations?' . http_build_query([
        'market' => 'FR',
        'seed_artists' => '4NHQUGzhtTLFvgF5SZesLK',
        'seed_genres' => 'classical',
        'seed_tracks' => '0c6xIDDpzE81m2q797ordA',
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($recommendations)->not->toBeEmpty();
});
