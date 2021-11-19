<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class EpisodeApi extends AbstractApi implements EpisodeApiInterface
{
    /**
     * URI suffix for the episode endpoint
     */
    public const EPISODE_URI = '/v1/episodes';

    /**
     * {@inheritdoc}
     */
    public function getEpisode(string $episodeId, array $options = []): array
    {
        return $this->resourceClient->get(self::EPISODE_URI . "/${episodeId}", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getEpisodes(array $episodesIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $episodesIds,
        ]);

        return $this->resourceClient->get(self::EPISODE_URI, $params);
    }

    public function getCurrentUserSavedEpisodes(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/episodes', $options);
    }

    public function checkCurrentUserSavedEpisodes(array $episodeIds): array
    {
        $params = [
            'ids' => $episodeIds,
        ];

        return $this->resourceClient->get('/v1/me/episodes/contains', $params);
    }

    public function removeCurrentUserSavedEpisodes(array $episodeIds): bool
    {
        $params = [
            'ids' => $episodeIds,
        ];

        $this->resourceClient->delete('/v1/me/episodes', $params);

        return true;
    }

    public function saveCurrentUserEpisodes(array $episodeIds): bool
    {
        $params = [
            'ids' => $episodeIds,
        ];

        $this->resourceClient->put('/v1/me/episodes', $params);

        return true;
    }
}
