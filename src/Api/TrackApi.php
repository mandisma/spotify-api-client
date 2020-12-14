<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class TrackApi extends AbstractApi implements TrackApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAudioAnalysis(string $trackId): array
    {
        return $this->resourceClient->get("/v1/audio-analysis/${trackId}");
    }

    /**
     * {@inheritdoc}
     */
    public function getAudioFeaturesForTrack(string $trackId): array
    {
        return $this->resourceClient->get("/v1/audio-features/${trackId}");
    }

    /**
     * {@inheritdoc}
     */
    public function getAudioFeaturesForTracks(array $trackIds): array
    {
        $params = [
            'ids' => $trackIds,
        ];

        return $this->resourceClient->get('/v1/audio-features', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getTracks(array $trackIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => implode(',', $trackIds),
        ]);

        return $this->resourceClient->get('/v1/tracks', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getTrack(string $trackId): array
    {
        return $this->resourceClient->get("/v1/tracks/${trackId}");
    }
}
