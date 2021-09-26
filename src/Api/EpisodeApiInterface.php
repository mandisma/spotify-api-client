<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface EpisodeApiInterface
{
    /**
     * Get Spotify catalog information for a single episode identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/episodes/get-an-episode/
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
     * https://developer.spotify.com/documentation/web-api/reference/episodes/get-several-episodes/
     *
     * @param array $episodesIds A list of the Spotify IDs for the episodes. Maximum: 50 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     *
     * @return array
     */
    public function getEpisodes(array $episodesIds, array $options = []): array;
}
