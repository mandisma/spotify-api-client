<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class PlayerApiTest extends ApiTestCase
{
    public function testGetUserAvailableDevice()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('devices')));

        $devices = $this->client->playerApi->getAvailableDevices();

        $this->assertNotEmpty($devices['devices']);
    }

    public function testGetPlayback()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('player')));

        $playback = $this->client->playerApi->getPlayback();

        $this->assertNotEmpty($playback);
    }

    public function testGetRecentlyPlayedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->playerApi->getRecentlyPlayedTracks();

        $this->assertNotEmpty($tracks);
    }

    public function testGetCurrentlyPlayingTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track')));

        $track = $this->client->playerApi->getCurrentlyPlayingTrack();

        $this->assertNotEmpty($track['id']);
    }

    public function testPausePlayback()
    {
        $this->mockHandler->append(new Response(200, []));

        $paused = $this->client->playerApi->pausePlayback();

        $this->assertTrue($paused);
    }

    public function testSeekToPosition()
    {
        $this->mockHandler->append(new Response(200, []));

        $seeked = $this->client->playerApi->seekToPosition(5);

        $this->assertTrue($seeked);
    }

    public function testSetRepeatMode()
    {
        $this->mockHandler->append(new Response(200, []));

        $set = $this->client->playerApi->setRepeatMode('off');

        $this->assertTrue($set);
    }

    public function testSetVolume()
    {
        $this->mockHandler->append(new Response(200));

        $set = $this->client->playerApi->setVolume(24);

        $this->assertTrue($set);
    }

    public function testSkipToNextTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->playerApi->skipToNextTrack();

        $this->assertTrue($skipped);
    }

    public function testSkipToPreviousTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->playerApi->skipToPreviousTrack();

        $this->assertTrue($skipped);
    }

    public function testStartPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $started = $this->client->playerApi->startPlayback();

        $this->assertTrue($started);
    }

    public function testToggleShuffle()
    {
        $this->mockHandler->append(new Response(200));

        $toggled = $this->client->playerApi->toggleShuffle(true);

        $this->assertTrue($toggled);
    }

    public function testTransferPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $transfered = $this->client->playerApi->transferPlayback(['74ASZWbe4lXaubB36ztrGX']);

        $this->assertTrue($transfered);
    }
}
