<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class TrackApiTest extends ApiTestCase
{
    public function testGetAudioAnalysis()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('audio-analysis')));

        $audioAnalysis = $this->client->trackApi->getAudioAnalysis('0eGsygTp906u18L0Oimnem');

        $this->assertNotEmpty($audioAnalysis['track']);
    }

    public function testGetAudioFeaturesForTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track-audio-features')));

        $audioFeatures = $this->client->trackApi->getAudioFeaturesForTrack('0eGsygTp906u18L0Oimnem');

        $this->assertNotEmpty($audioFeatures['id']);
    }

    public function testGetAudioFeaturesForTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks-audio-features')));

        $audioFeatures = $this->client->trackApi->getAudioFeaturesForTracks([
            '0eGsygTp906u18L0Oimnem',
            'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
        ]);

        $this->assertNotEmpty($audioFeatures['audio_features']);
    }

    public function testGetTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $audioFeatures = $this->client->trackApi->getTracks([
            '0eGsygTp906u18L0Oimnem',
            'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
        ]);

        $this->assertNotEmpty($audioFeatures['tracks']);
    }

    public function testGetTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track')));

        $audioFeatures = $this->client->trackApi->getTrack('0eGsygTp906u18L0Oimnem');

        $this->assertNotEmpty($audioFeatures['id']);
    }
}
