<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface LibraryApiInterface
{
    /**
     * Check if one or more albums is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/check-users-saved-albums/
     *
     * @param array $albumsIds List of the Spotify IDs for the albums
     * @return array
     */
    public function checkCurrentUserSavedAlbums(array $albumsIds): array;

    /**
     * Check if one or more tracks is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/check-users-saved-tracks/
     *
     * @param array $trackIds List of the Spotify IDs for the tracks
     * @return array
     */
    public function checkCurrentUserSavedTracks(array $trackIds): array;

    /**
     * Get a list of the albums saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/get-users-saved-albums/
     *
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getCurrentUserSavedAlbums(array $options = []): array;

    /**
     * Get a list of the songs saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/get-users-saved-tracks/
     *
     * @param array $options
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getCurrentUserSavedTracks(array $options = []): array;

    /**
     * Remove one or more albums from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/remove-albums-user/
     *
     * @param array $albumIds List of the Albums Spotify IDs
     * @return bool
     */
    public function removeCurrentUserSavedAlbums(array $albumIds): bool;

    /**
     * Remove one or more tracks from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/remove-tracks-user/
     *
     * @param array $trackIds List of the tracks Spotify IDs
     * @return bool
     */
    public function removeCurrentUserSavedTracks(array $trackIds): bool;

    /**
     * Save one or more albums to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/save-albums-user/
     *
     * @param array $albumIds List of the album Spotify IDs
     * @return boolean
     */
    public function saveCurrentUserAlbums(array $albumIds): bool;

    /**
     * Save one or more tracks to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/save-tracks-user/
     *
     * @param array $trackIds List of the track Spotify IDs
     * @return boolean
     */
    public function saveCurrentUserTracks(array $trackIds): bool;
}
