<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class ShowApi extends AbstractApi implements ShowApiInterface
{
    /**
     * URI suffix for the show endpoint
     */
    public const SHOW_URI = '/v1/shows';

    /**
     * {@inheritdoc}
     */
    public function getShow(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getShows(array $showsIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $showsIds,
        ]);

        return $this->resourceClient->get(self::SHOW_URI, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getShowEpisodes(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}/episodes", $options);
    }

    public function getCurrentUserSavedShows(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/shows', $options);
    }

    public function checkCurrentUserSavedShows(array $showIds): array
    {
        $params = [
            'ids' => $showIds,
        ];

        return $this->resourceClient->get('/v1/me/shows/contains', $params);
    }

    public function removeCurrentUserSavedShows(array $showIds, array $options = []): bool
    {
        $params = array_merge($options, [
            'ids' => $showIds,
        ]);

        $this->resourceClient->delete('/v1/me/shows', $params);

        return true;
    }

    public function saveCurrentUserShows(array $showIds): bool
    {
        $params = [
            'ids' => $showIds,
        ];

        $this->resourceClient->put('/v1/me/shows', $params);

        return true;
    }
}
