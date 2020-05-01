<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

final class EpisodeApi
{
    /**
     * URI suffix for the episode endpoint
     *
     * @var string
     */
    public const EPISODE_URI = '/v1/episodes';

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
     * Get Spotify catalog information for a single episode identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/episodes/get-an-episode/
     *
     * @param string $episodeId The Spotify ID for the episode.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getEpisode(string $episodeId, array $options = []): array
    {
        return $this->resourceClient->get(self::EPISODE_URI . "/$episodeId", $options);
    }

    /**
     * Get Spotify catalog information for multiple episodes based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/episodes/get-several-episodes/
     *
     * @param array $episodesIds A list of the Spotify IDs for the episodes. Maximum: 50 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getEpisodes(array $episodesIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $episodesIds,
        ]);

        return $this->resourceClient->get(self::EPISODE_URI, $params);
    }
}
