<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class ArtistApi extends AbstractApi implements ArtistApiInterface
{
    /**
     * URI suffix for the artists endpoint
     */
    public const ARTIST_URI = '/v1/artists';

    /**
     * {@inheritdoc}
     */
    public function getArtist(string $artistId): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlbums(string $artistId, array $options = []): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/albums', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getTopTracks(string $artistId, string $country): array
    {
        $params = [
            'country' => $country,
        ];

        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/top-tracks', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getRelatedArtists(string $artistId): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/related-artists');
    }

    /**
     * {@inheritdoc}
     */
    public function getArtists(array $artistIds): array
    {
        $params = [
            'ids' => $artistIds,
        ];

        return $this->resourceClient->get(self::ARTIST_URI, $params);
    }
}
