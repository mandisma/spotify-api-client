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
