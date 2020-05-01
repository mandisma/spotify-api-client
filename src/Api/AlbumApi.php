<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

final class AlbumApi
{
    /**
     * URI suffix for album's endpoint
     *
     * @var string
     */
    public const ALBUM_URI = '/v1/albums';

    /**
     * @var ResourceClient
     */
    private $resourceClient;

    /**
     * @param ResourceClient $resourceClient
     */
    public function __construct(ResourceClient $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * Get Spotify catalog information for a single album.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-album/
     *
     * @param string $albumId The Spotify ID for the album
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getAlbum(string $albumId, array $options = []): array
    {
        return $this->resourceClient->get(self::ALBUM_URI . '/' . $albumId, $options);
    }

    /**
     * Get Spotify catalog information about an album’s tracks.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-albums-tracks/
     *
     * @param string $albumId The Spotify ID for the album
     * @param array $options
     * - int limit The maximum number of tracks to return
     * - int offset The index of the first track to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getTracks(string $albumId, array $options = []): array
    {
        return $this->resourceClient->get(self::ALBUM_URI . '/' . $albumId . '/tracks', $options);
    }

    /**
     * Get Spotify catalog information for multiple albums identified by their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-several-albums/
     *
     * @param array $albumIds List of the Spotify IDs for the albums
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getAlbums(array $albumIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $albumIds,
        ]);

        return $this->resourceClient->get(self::ALBUM_URI, $params);
    }
}
