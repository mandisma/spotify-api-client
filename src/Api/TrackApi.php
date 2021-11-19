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

    /**
     * {@inheritdoc}
     */
    public function getRecommendations(array $seedArtists, array $seedGenres, array $seedTracks, array $options = []): array
    {
        $options = array_merge($options, [
            'seed_artists' => implode(',', $seedArtists),
            'seed_genres' => implode(',', $seedGenres),
            'seed_tracks' => implode(',', $seedTracks),
        ]);

        return $this->resourceClient->get('/v1/recommendations', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function checkCurrentUserSavedTracks(array $trackIds): array
    {
        $params = [
            'ids' => $trackIds,
        ];

        return $this->resourceClient->get('/v1/me/tracks/contains', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentUserSavedTracks(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/tracks', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function removeCurrentUserSavedTracks(array $trackIds): bool
    {
        $params = [
            'ids' => $trackIds,
        ];

        $this->resourceClient->delete('/v1/me/tracks', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function saveCurrentUserTracks(array $trackIds): bool
    {
        $params = [
            'ids' => $trackIds,
        ];

        $this->resourceClient->put('/v1/me/tracks', $params);

        return true;
    }
}
