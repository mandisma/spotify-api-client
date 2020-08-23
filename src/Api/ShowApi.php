<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class ShowApi extends AbstractApi
{
    /**
     * URI suffix for the show endpoint
     *
     * @var string
     */
    public const SHOW_URI = '/v1/shows';

    /**
     * Get Spotify catalog information for a single show identified by its unique Spotify ID.
     * https://developer.spotify.com/documentation/web-api/reference/shows/get-a-show/
     *
     * @param string $showId The Spotify ID for the show.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getShow(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}", $options);
    }

    /**
     * Get Spotify catalog information for multiple shows based on their Spotify IDs.
     * https://developer.spotify.com/documentation/web-api/reference/shows/get-several-shows/
     *
     * @param array $showsIds A comma-separated list of the Spotify IDs for the shows. Maximum: 50 IDs.
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getShows(array $showsIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $showsIds,
        ]);

        return $this->resourceClient->get(self::SHOW_URI, $params);
    }

    /**
     * Get Spotify catalog information about an show’s episodes.
     * Optional parameters can be used to limit the number of episodes returned.
     * https://developer.spotify.com/documentation/web-api/reference/shows/get-shows-episodes/
     *
     * @param string $showId The Spotify ID for the show.
     * @param array $options
     * - int limit The number of album objects to return
     * - int offset The index of the first album to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getShowEpisodes(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}/episodes", $options);
    }
}
