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
}
