<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface TrackApiInterface
{
    /**
     * Get a detailed audio analysis for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/tracks/get-audio-analysis/
     *
     * @param string $trackId The Spotify ID for the track.
     * @return array
     */
    public function getAudioAnalysis(string $trackId): array;

    /**
     * Get audio feature information for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/tracks/get-audio-features/
     *
     * @param string $trackId The Spotify ID for the track.
     * @return array
     */
    public function getAudioFeaturesForTrack(string $trackId): array;

    /**
     * Get audio features for multiple tracks based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/tracks/get-several-audio-features/
     *
     * @param array $trackIds A list of the Spotify IDs for the tracks. Maximum: 100 IDs.
     * @return array
     */
    public function getAudioFeaturesForTracks(array $trackIds): array;

    /**
     * Get Spotify catalog information for multiple tracks based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/tracks/get-several-tracks/
     *
     * @param array $trackIds A list of the Spotify IDs for the tracks. Maximum: 100 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getTracks(array $trackIds, array $options = []): array;

    /**
     * Get Spotify catalog information for a single track identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/tracks/get-track/
     *
     * @param string $trackId The Spotify ID for the track.
     *
     * @return array
     */
    public function getTrack(string $trackId): array;
}
