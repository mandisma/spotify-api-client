<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface TrackApiInterface
{
    /**
     * Get a detailed audio analysis for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-audio-analysis
     *
     * @param string $trackId The Spotify ID for the track.
     *
     * @return array
     */
    public function getAudioAnalysis(string $trackId): array;

    /**
     * Get audio feature information for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-audio-features
     *
     * @param string $trackId The Spotify ID for the track.
     *
     * @return array
     */
    public function getAudioFeaturesForTrack(string $trackId): array;

    /**
     * Get audio features for multiple tracks based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-several-audio-features
     *
     * @param array $trackIds A list of the Spotify IDs for the tracks. Maximum: 100 IDs.
     *
     * @return array
     */
    public function getAudioFeaturesForTracks(array $trackIds): array;

    /**
     * Get Spotify catalog information for multiple tracks based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-several-tracks
     *
     * @param array<string> $trackIds A list of the Spotify IDs for the tracks. Maximum: 100 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getTracks(array $trackIds, array $options = []): array;

    /**
     * Get Spotify catalog information for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-track
     *
     * @param string $trackId The Spotify ID for the track.
     *
     * @return array
     */
    public function getTrack(string $trackId): array;

    /**
     * Create a playlist-style listening experience based on seed artists, tracks and genres
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-recommendations
     *
     * @param array<string> $seedArtists
     * @param array<string> $seedGenres
     * @param array<string> $seedTracks
     * @param array $options
     * - int limit The target size of the list of recommended tracks
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - mixed max_* For each tunable track attribute, a hard ceiling
     *               on the selected track attribute’s value can be provided
     * - mixed min_* For each tunable track attribute, a hard floor
     *                on the selected track attribute’s value can be provided
     * - target_* For each of the tunable track attributes (below) a target value may be provided
     *
     * @return array
     */
    public function getRecommendations(array $seedArtists, array $seedGenres, array $seedTracks, array $options = []): array;

    /**
     * Check if one or more tracks is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-users-saved-tracks
     *
     * @param array $trackIds List of the Spotify IDs for the tracks
     *
     * @return array
     */
    public function checkCurrentUserSavedTracks(array $trackIds): array;

    /**
     * Get a list of the songs saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-saved-tracks
     *
     * @param array $options
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getCurrentUserSavedTracks(array $options = []): array;

    /**
     * Remove one or more tracks from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/remove-tracks-user
     *
     * @param array $trackIds List of the tracks Spotify IDs
     */
    public function removeCurrentUserSavedTracks(array $trackIds): bool;

    /**
     * Save one or more tracks to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/save-tracks-user
     *
     * @param array $trackIds List of the track Spotify IDs
     */
    public function saveCurrentUserTracks(array $trackIds): bool;
}
