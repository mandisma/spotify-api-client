<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface AlbumApiInterface
{
    /**
     * Get Spotify catalog information for a single album.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-album/
     *
     * @param string $albumId The Spotify ID for the album
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getAlbum(string $albumId, array $options = []): array;

    /**
     * Get Spotify catalog information about an album’s tracks.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-albums-tracks/
     *
     * @param string $albumId The Spotify ID for the album
     * @param array $options
     * - int limit The maximum number of tracks to return
     * - int offset The index of the first track to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getTracks(string $albumId, array $options = []): array;

    /**
     * Get Spotify catalog information for multiple albums identified by their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/albums/get-several-albums/
     *
     * @param array $albumIds List of the Spotify IDs for the albums
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getAlbums(array $albumIds, array $options = []): array;
}
