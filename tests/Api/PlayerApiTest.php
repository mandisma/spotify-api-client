<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PlayerApiTest extends ApiTestCase
{
    public function testGetUserAvailableDevice()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('devices')));

        $devices = $this->client->playerApi->getAvailableDevices();

        $requestUri = PlayerApi::PLAYER_URI . '/devices';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($devices['devices']);
    }

    public function testGetPlayback()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('player')));

        $playback = $this->client->playerApi->getPlayback();

        $requestUri = PlayerApi::PLAYER_URI;

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playback);
    }

    public function testGetRecentlyPlayedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->playerApi->getRecentlyPlayedTracks();

        $requestUri = PlayerApi::PLAYER_URI . '/recently-played';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($tracks);
    }

    public function testGetCurrentlyPlayingTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track')));

        $track = $this->client->playerApi->getCurrentlyPlayingTrack();

        $requestUri = PlayerApi::PLAYER_URI . '/currently-playing';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($track['id']);
    }

    public function testPausePlayback()
    {
        $this->mockHandler->append(new Response(200, []));

        $paused = $this->client->playerApi->pausePlayback();

        $requestUri = PlayerApi::PLAYER_URI . '/pause';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($paused);
    }

    public function testSeekToPosition()
    {
        $this->mockHandler->append(new Response(200, []));

        $seeked = $this->client->playerApi->seekToPosition(5, ['device_id' => 'device_id']);

        $requestUri = PlayerApi::PLAYER_URI . '/seek';

        $this->assertEquals($requestUri, $this->getLastRequestUri()->__toString());
        $this->assertEquals(['device_id' => 'device_id', 'position_ms' => 5], $this->lastRequestJson());
        $this->assertTrue($seeked);
    }

    public function testSetRepeatMode()
    {
        $this->mockHandler->append(new Response(200, []));

        $set = $this->client->playerApi->setRepeatMode('off', ['device_id' => 'device_id']);

        $requestUri = PlayerApi::PLAYER_URI . '/repeat';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['device_id' => 'device_id', 'state' => 'off'], $this->lastRequestJson());
        $this->assertTrue($set);
    }

    public function testSetVolume()
    {
        $this->mockHandler->append(new Response(200));

        $set = $this->client->playerApi->setVolume(24, ['device_id' => 'device_id']);

        $requestUri = PlayerApi::PLAYER_URI . '/volume';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['device_id' => 'device_id', 'volume_percent' => 24], $this->lastRequestJson());
        $this->assertTrue($set);
    }

    public function testSkipToNextTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->playerApi->skipToNextTrack();

        $requestUri = PlayerApi::PLAYER_URI . '/next';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($skipped);
    }

    public function testSkipToPreviousTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->playerApi->skipToPreviousTrack();

        $requestUri = PlayerApi::PLAYER_URI . '/previous';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($skipped);
    }

    public function testStartPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $started = $this->client->playerApi->startPlayback();

        $requestUri = PlayerApi::PLAYER_URI . '/play';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertTrue($started);
    }

    public function testToggleShuffle()
    {
        $this->mockHandler->append(new Response(200));

        $toggled = $this->client->playerApi->toggleShuffle(true, ['device_id' => 'device_id']);

        $requestUri = PlayerApi::PLAYER_URI . '/shuffle';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['device_id' => 'device_id', 'state' => true], $this->lastRequestJson());
        $this->assertTrue($toggled);
    }

    public function testTransferPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $transfered = $this->client->playerApi->transferPlayback(['74ASZWbe4lXaubB36ztrGX'], ['play' => true]);

        $requestUri = PlayerApi::PLAYER_URI;

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertEquals(['play' => true, 'device_ids' => ['74ASZWbe4lXaubB36ztrGX']], $this->lastRequestJson());
        $this->assertTrue($transfered);
    }
}
