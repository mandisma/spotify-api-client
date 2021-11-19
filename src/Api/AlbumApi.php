<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class AlbumApi extends AbstractApi implements AlbumApiInterface
{
    /**
     * URI suffix for album's endpoint
     */
    public const ALBUM_URI = '/v1/albums';

    /**
     * {@inheritdoc}
     */
    public function getAlbum(string $albumId, array $options = []): array
    {
        return $this->resourceClient->get(self::ALBUM_URI . '/' . $albumId, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getTracks(string $albumId, array $options = []): array
    {
        return $this->resourceClient->get(self::ALBUM_URI . '/' . $albumId . '/tracks', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlbums(array $albumIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $albumIds,
        ]);

        return $this->resourceClient->get(self::ALBUM_URI, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getNewReleases(array $options = []): array
    {
        return $this->resourceClient->get('/v1/browse/new-releases', $options);
    }

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
    public function getCurrentUserSavedAlbums(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/albums', $options);
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
    public function saveCurrentUserAlbums(array $albumIds): bool
    {
        $params = [
            'ids' => $albumIds,
        ];

        $this->resourceClient->put('/v1/me/albums', $params);

        return true;
    }
}
