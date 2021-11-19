<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface ShowApiInterface
{
    /**
     * Get Spotify catalog information for a single show identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-show
     *
     * @param string $showId The Spotify ID for the show.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getShow(string $showId, array $options = []): array;

    /**
     * Get Spotify catalog information for multiple shows based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-show
     *
     * @param array $showsIds A comma-separated list of the Spotify IDs for the shows. Maximum: 50 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getShows(array $showsIds, array $options = []): array;

    /**
     * Get Spotify catalog information about an show’s episodes.
     * Optional parameters can be used to limit the number of episodes returned.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-shows-episodes
     *
     * @param string $showId The Spotify ID for the show.
     * @param array $options
     * - int limit The number of album objects to return
     * - int offset The index of the first album to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getShowEpisodes(string $showId, array $options = []): array;

    /**
     * Get User's Saved Shows
     * Get a list of shows saved in the current Spotify user's library. Optional parameters can be used to limit the number of shows returned.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-saved-shows
     *
     * @param array $options
     * - int limit The number of album objects to return
     * - int offset The index of the first album to return
     * @return array
     */
    public function getCurrentUserSavedShows(array $options = []): array;

    /**
     * Check User's Saved Shows
     * Check if one or more shows is already saved in the current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-users-saved-shows
     *
     * @param array $showIds List of the Spotify IDs for the shows
     *
     * @return array
     */
    public function checkCurrentUserSavedShows(array $showIds): array;

    /**
     * Remove User's Saved Shows
     * Delete one or more shows from current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/remove-shows-user
     *
     * @param array $showIds List of the shows Spotify IDs
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     */
    public function removeCurrentUserSavedShows(array $showIds, array $options = []): bool;

    /**
     * Save Shows for Current User
     * Save one or more shows to current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/save-shows-user
     *
     * @param array $showIds List of the show Spotify IDs
     */
    public function saveCurrentUserShows(array $showIds): bool;
}
