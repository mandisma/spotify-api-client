<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface BrowseApiInterface
{
    /**
     * Get a single category used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-category/
     *
     * @param string $categoryId The Spotify category ID for the category
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - string locale The desired language consisting of an ISO 639-1 language code
     *                  and an ISO 3166-1 alpha-2 country code
     * @return array
     */
    public function getCategory(string $categoryId, array $options = []): array;

    /**
     * Get a list of Spotify playlists tagged with a particular category
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-categorys-playlists/
     *
     * @param string $categoryId The Spotify category ID for the category
     * @param array $options
     * - integer limit The maximum number of items to return
     * - integer offset The index of the first item to return
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * @return array
     */
    public function getPlaylistsByCategory(string $categoryId, array $options = []): array;

    /**
     * Get a list of categories used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-list-categories/
     *
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - string locale The desired language, consisting of an ISO 639-1 language code
     *                 and an ISO 3166-1 alpha-2 country code
     * - int limit The maximum number of categories to return
     * - int offset The index of the first item to return
     * @return array
     */
    public function getCategories(array $options = []): array;

    /**
     * Get a list of Spotify featured playlists (shown, for example, on a Spotify player’s ‘Browse’ tab)
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-list-featured-playlists/
     *
     * @param array $options
     * - string locale The desired language, consisting of an ISO 639-1 language code
     *                  and an ISO 3166-1 alpha-2 country code
     * - string country A country: an ISO 3166-1 alpha-2 country code
     *                    the user’s local time to get results tailored for that specific date and time in the day
     * - string timestamp A timestamp in ISO 8601 format: yyyy-MM-ddTHH:mm:ss. Use this parameter to specify
     * - int limit The maximum number of items to return
     * - int offset The index of the first item to return
     * @return array
     */
    public function getFeaturedPlaylists(array $options = []): array;

    /**
     * Get a list of new album releases featured in Spotify (shown, for example, on a Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-list-new-releases/
     *
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - int limit The maximum number of items to return
     * - int offset The index of the first item to return
     * @return array
     */
    public function getNewReleases(array $options = []): array;

    /**
     * Create a playlist-style listening experience based on seed artists, tracks and genres
     * https://developer.spotify.com/documentation/web-api/reference/browse/get-recommendations/
     *
     * @param array $options
     * - int limit The target size of the list of recommended tracks
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - mixed max_* For each tunable track attribute, a hard ceiling
     *               on the selected track attribute’s value can be provided
     * - mixed min_* For each tunable track attribute, a hard floor
     *                on the selected track attribute’s value can be provided
     * - array seedGenres List of any genres in the set of available genre seeds
     * - array seedTracks List of Spotify IDs for a seed track
     * - array seedArtists List of Spotify IDs for seed artists
     * - target_* For each of the tunable track attributes (below) a target value may be provided
     * @return array
     */
    public function getRecommendations(array $options = []): array;
}
