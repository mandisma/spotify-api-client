<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface AlbumApiInterface
{
    /**
     * Get Spotify catalog information for a single album.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-an-album
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
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-an-albums-tracks
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
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-multiple-albums
     *
     * @param array $albumIds List of the Spotify IDs for the albums
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getAlbums(array $albumIds, array $options = []): array;

    /**
     * Get a list of new album releases featured in Spotify (shown, for example, on a Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-new-releases
     *
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - int limit The maximum number of items to return
     * - int offset The index of the first item to return
     *
     * @return array
     */
    public function getNewReleases(array $options = []): array;

    /**
     * Check if one or more albums is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-users-saved-albums
     *
     * @param array $albumsIds List of the Spotify IDs for the albums
     *
     * @return array
     */
    public function checkCurrentUserSavedAlbums(array $albumsIds): array;

    /**
     * Get a list of the albums saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-saved-albums
     *
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getCurrentUserSavedAlbums(array $options = []): array;

    /**
     * Remove one or more albums from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/remove-albums-user
     *
     * @param array $albumIds List of the Albums Spotify IDs
     */
    public function removeCurrentUserSavedAlbums(array $albumIds): bool;

    /**
     * Save one or more albums to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/save-albums-user
     *
     * @param array $albumIds List of the album Spotify IDs
     */
    public function saveCurrentUserAlbums(array $albumIds): bool;
}
