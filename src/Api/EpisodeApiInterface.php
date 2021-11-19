<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface EpisodeApiInterface
{
    /**
     * Get Spotify catalog information for a single episode identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-an-episode
     *
     * @param string $episodeId The Spotify ID for the episode.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getEpisode(string $episodeId, array $options = []): array;

    /**
     * Get Spotify catalog information for multiple episodes based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-multiple-episodes
     *
     * @param array $episodesIds A list of the Spotify IDs for the episodes. Maximum: 50 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getEpisodes(array $episodesIds, array $options = []): array;

    /**
     * Get User's Saved Episodes
     * Get a list of episodes saved in the current Spotify user's library. Optional parameters can be used to limit the number of episodes returned.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-saved-episodes
     *
     * @param array $options
     * - int limit The number of album objects to return
     * - int offset The index of the first album to return
     * @return array
     */
    public function getCurrentUserSavedEpisodes(array $options = []): array;

    /**
     * Check User's Saved Episodes
     * Check if one or more episodes is already saved in the current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-users-saved-episodes
     *
     * @param array $episodeIds List of the Spotify IDs for the episodes
     *
     * @return array
     */
    public function checkCurrentUserSavedEpisodes(array $episodeIds): array;

    /**
     * Remove User's Saved Episodes
     * Delete one or more episodes from current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/remove-episodes-user
     *
     * @param array $episodeIds List of the episodes Spotify IDs
     */
    public function removeCurrentUserSavedEpisodes(array $episodeIds): bool;

    /**
     * Save Episodes for Current User
     * Save one or more episodes to current Spotify user's library.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/save-episodes-user
     *
     * @param array $episodeIds List of the episode Spotify IDs
     */
    public function saveCurrentUserEpisodes(array $episodeIds): bool;
}
