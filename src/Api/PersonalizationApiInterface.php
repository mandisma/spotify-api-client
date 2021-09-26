<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface PersonalizationApiInterface
{
    /**
     * Get the current user’s top artists based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     *
     * @return array
     */
    public function getCurrentUserTopArtists(array $options = []): array;

    /**
     * Get the current user’s top tracks based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     *
     * @return array
     */
    public function getCurrentUserTopTracks(array $options = []): array;
}
