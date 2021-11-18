<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\PlayerApi;

it('can get user available device', function () {
    mockHandler()->append(new Response(200, [], load_fixture('devices')));

    $devices = client()->playerApi->getAvailableDevices();

    $requestUri = PlayerApi::PLAYER_URI . '/devices';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($devices['devices'])->not->toBeEmpty();
});

it('can get playback', function () {
    mockHandler()->append(new Response(200, [], load_fixture('player')));

    $playback = client()->playerApi->getPlayback();

    $requestUri = PlayerApi::PLAYER_URI;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playback)->not->toBeEmpty();
});

it('can get recently played tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracks = client()->playerApi->getRecentlyPlayedTracks();

    $requestUri = PlayerApi::PLAYER_URI . '/recently-played';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can get currently playing track', function () {
    mockHandler()->append(new Response(200, [], load_fixture('track')));

    $track = client()->playerApi->getCurrentlyPlayingTrack();

    $requestUri = PlayerApi::PLAYER_URI . '/currently-playing';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($track['id'])->not->toBeEmpty();
});

it('can pause playback', function () {
    mockHandler()->append(new Response(200, []));

    $paused = client()->playerApi->pausePlayback();

    $requestUri = PlayerApi::PLAYER_URI . '/pause';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($paused)->toBeTrue();
});

it('can seek to position', function () {
    mockHandler()->append(new Response(200, []));

    $seeked = client()->playerApi->seekToPosition(5, ['device_id' => 'device_id']);

    $requestUri = PlayerApi::PLAYER_URI . '/seek';

    expect(lastRequestUri()->__toString())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['device_id' => 'device_id', 'position_ms' => 5]);
    expect($seeked)->toBeTrue();
});

it('can set repeat mode', function () {
    mockHandler()->append(new Response(200, []));

    $set = client()->playerApi->setRepeatMode('off', ['device_id' => 'device_id']);

    $requestUri = PlayerApi::PLAYER_URI . '/repeat';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['device_id' => 'device_id', 'state' => 'off']);
    expect($set)->toBeTrue();
});

it('can set volume', function () {
    mockHandler()->append(new Response(200));

    $set = client()->playerApi->setVolume(24, ['device_id' => 'device_id']);

    $requestUri = PlayerApi::PLAYER_URI . '/volume';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['device_id' => 'device_id', 'volume_percent' => 24]);
    expect($set)->toBeTrue();
});

it('can skip to next track', function () {
    mockHandler()->append(new Response(200));

    $skipped = client()->playerApi->skipToNextTrack();

    $requestUri = PlayerApi::PLAYER_URI . '/next';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($skipped)->toBeTrue();
});

it('can skip to previous track', function () {
    mockHandler()->append(new Response(200));

    $skipped = client()->playerApi->skipToPreviousTrack();

    $requestUri = PlayerApi::PLAYER_URI . '/previous';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($skipped)->toBeTrue();
});

it('can start playback', function () {
    mockHandler()->append(new Response(200));

    $started = client()->playerApi->startPlayback();

    $requestUri = PlayerApi::PLAYER_URI . '/play';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($started)->toBeTrue();
});

it('can toggle shuffle', function () {
    mockHandler()->append(new Response(200));

    $toggled = client()->playerApi->toggleShuffle(true, ['device_id' => 'device_id']);

    $requestUri = PlayerApi::PLAYER_URI . '/shuffle';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['device_id' => 'device_id', 'state' => true]);
    expect($toggled)->toBeTrue();
});

it('can transfer playback', function () {
    mockHandler()->append(new Response(200));

    $transfered = client()->playerApi->transferPlayback(['74ASZWbe4lXaubB36ztrGX'], ['play' => true]);

    $requestUri = PlayerApi::PLAYER_URI;

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['play' => true, 'device_ids' => ['74ASZWbe4lXaubB36ztrGX']]);
    expect($transfered)->toBeTrue();
});
