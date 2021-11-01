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

        $trackId = '0eGsygTp906u18L0Oimnem';

        $audioAnalysis = $this->client->trackApi->getAudioAnalysis($trackId);

        $requestUri = "/v1/audio-analysis/${trackId}";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($audioAnalysis['track']);
    }

    public function testGetAudioFeaturesForTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track-audio-features')));

        $trackId = '0eGsygTp906u18L0Oimnem';

        $audioFeatures = $this->client->trackApi->getAudioFeaturesForTrack($trackId);

        $requestUri = "/v1/audio-features/${trackId}";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($audioFeatures['id']);
    }

    public function testGetAudioFeaturesForTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks-audio-features')));

        $trackIds = [
            '0eGsygTp906u18L0Oimnem',
            'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
        ];

        $audioFeatures = $this->client->trackApi->getAudioFeaturesForTracks($trackIds);

        $requestUri = "/v1/audio-features?" . http_build_query(['ids' => $trackIds]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($audioFeatures['audio_features']);
    }

    public function testGetTracks()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $trackIds = [
            '0eGsygTp906u18L0Oimnem',
            'spotify:track:1lDWb6b6ieDQ2xT7ewTC3G',
        ];

        $audioFeatures = $this->client->trackApi->getTracks($trackIds, ['market' => 'FR']);

        $requestUri = "/v1/tracks?" . http_build_query(['market' => 'FR', 'ids' => implode(',', $trackIds)]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($audioFeatures['tracks']);
    }

    public function testGetTrack()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('track')));

        $trackId = '0eGsygTp906u18L0Oimnem';

        $audioFeatures = $this->client->trackApi->getTrack($trackId);

        $requestUri = "/v1/tracks/$trackId";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($audioFeatures['id']);
    }
}
