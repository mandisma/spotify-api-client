<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\Api\ApiTestCase;

class PlayerApiTest extends ApiTestCase
{
    public function testGetUserAvailableDevice()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('devices')));

        $devices = $this->client->getPlayerApi()->getAvailableDevices();

        $this->assertNotEmpty($devices['devices']);
    }

    public function testGetPlayback()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('player')));

        $playback = $this->client->getPlayerApi()->getPlayback();

        $this->assertNotEmpty($playback);
    }

    public function testGetRecentlyPlayedTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $tracks = $this->client->getPlayerApi()->getRecentlyPlayedTracks();

        $this->assertNotEmpty($tracks);
    }

    public function testGetCurrentlyPlayingTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track')));

        $track = $this->client->getPlayerApi()->getCurrentlyPlayingTrack();

        $this->assertNotEmpty($track['id']);
    }

    public function testPausePlayback()
    {
        $this->mockHandler->append(new Response(200, []));

        $paused = $this->client->getPlayerApi()->pausePlayback();

        $this->assertTrue($paused);
    }

    public function testSeekToPosition()
    {
        $this->mockHandler->append(new Response(200, []));

        $seeked = $this->client->getPlayerApi()->seekToPosition(5);

        $this->assertTrue($seeked);
    }

    public function testSetRepeatMode()
    {
        $this->mockHandler->append(new Response(200, []));

        $set = $this->client->getPlayerApi()->setRepeatMode('off');

        $this->assertTrue($set);
    }

    public function testSetVolume()
    {
        $this->mockHandler->append(new Response(200));

        $set = $this->client->getPlayerApi()->setVolume(24);

        $this->assertTrue($set);
    }

    public function testSkipToNextTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->getPlayerApi()->skipToNextTrack();

        $this->assertTrue($skipped);
    }

    public function testSkipToPreviousTrack()
    {
        $this->mockHandler->append(new Response(200));

        $skipped = $this->client->getPlayerApi()->skipToPreviousTrack();

        $this->assertTrue($skipped);
    }

    public function testStartPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $started = $this->client->getPlayerApi()->startPlayback();

        $this->assertTrue($started);
    }

    public function testToggleShuffle()
    {
        $this->mockHandler->append(new Response(200));

        $toggled = $this->client->getPlayerApi()->toggleShuffle(true);

        $this->assertTrue($toggled);
    }

    public function testTransferPlayback()
    {
        $this->mockHandler->append(new Response(200));

        $transfered = $this->client->getPlayerApi()->transferPlayback(['74ASZWbe4lXaubB36ztrGX']);

        $this->assertTrue($transfered);
    }
}
