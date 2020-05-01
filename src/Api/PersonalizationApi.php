<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

final class PersonalizationApi
{
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
     * Get the current user’s top artists based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     * @return array
     */
    public function getCurrentUserTopArtists(array $options = []): array
    {
        return $this->getCurrentUserTopArtistsAndTracks('artists', $options);
    }

    /**
     * Get the current user’s top tracks based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     * @return array
     */
    public function getCurrentUserTopTracks(array $options = []): array
    {
        return $this->getCurrentUserTopArtistsAndTracks('tracks', $options);
    }

    /**
     * Get the current user’s top artists or tracks based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/
     *
     * @param string $type The type of entity to return
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     * @return array
     */
    private function getCurrentUserTopArtistsAndTracks(string $type, array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/top/' . $type, $options);
    }
}
