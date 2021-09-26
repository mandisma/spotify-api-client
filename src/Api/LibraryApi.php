<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class LibraryApi extends AbstractApi implements LibraryApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkCurrentUserSavedAlbums(array $albumsIds): array
    {
        $params = [
            'ids' => $albumsIds,
        ];

        return $this->resourceClient->get('/v1/me/albums/contains', $params);
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
    public function getCurrentUserSavedAlbums(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/albums', $options);
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
    public function removeCurrentUserSavedAlbums(array $albumIds): bool
    {
        $params = [
            'ids' => $albumIds,
        ];

        $this->resourceClient->delete('/v1/me/albums', $params);

        return true;
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
    public function saveCurrentUserAlbums(array $albumIds): bool
    {
        $params = [
            'ids' => $albumIds,
        ];

        $this->resourceClient->put('/v1/me/albums', $params);

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
