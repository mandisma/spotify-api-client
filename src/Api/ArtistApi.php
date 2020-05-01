<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

final class ArtistApi
{
    /**
     * URI suffix for the artists endpoint
     *
     * @var string
     */
    public const ARTIST_URI = '/v1/artists';

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
     * Get Spotify catalog information for a single artist identified by their unique Spotify ID
     * https://developer.spotify.com/documentation/web-api/reference/artists/get-artist/
     *
     * @param string $artistId The Spotify ID for the artist
     * @return array
     */
    public function getArtist(string $artistId): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId);
    }

    /**
     * Get Spotify catalog information about an artist’s albums.
     * https://developer.spotify.com/documentation/web-api/reference/artists/get-artists-albums/
     *
     * @param string $artistId The Spotify ID of the the artist
     * @param array $options Optional parameters
     * - string|array include_groups List of keywords that will be used to filter the response
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - int limit The number of album objects to return
     * - int offset The index of the first album to return
     * @return array
     */
    public function getAlbums(string $artistId, array $options = []): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/albums', $options);
    }

    /**
     * Get Spotify catalog information about an artist’s top tracks by country
     * https://developer.spotify.com/documentation/web-api/reference/artists/get-artists-top-tracks/
     *
     * @param string $artistId The Spotify ID for the artist
     * @param string $country An ISO 3166-1 alpha-2 country code or the string from_token.
     * @return array
     */
    public function getTopTracks(string $artistId, string $country): array
    {
        $params = [
            'country' => $country,
        ];

        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/top-tracks', $params);
    }

    /**
     * Get Spotify catalog information about artists similar to a given artist.
     * Similarity is based on analysis of the Spotify community’s listening history
     * https://developer.spotify.com/documentation/web-api/reference/artists/get-related-artists/
     *
     * @param string $artistId The Spotify ID for the artist
     * @return array
     */
    public function getRelatedArtists(string $artistId): array
    {
        return $this->resourceClient->get(self::ARTIST_URI . '/' . $artistId . '/related-artists');
    }

    /**
     * Get Spotify catalog information for several artists based on their Spotify IDs
     * https://developer.spotify.com/documentation/web-api/reference/artists/get-several-artists/
     *
     * @param array $artistIds List of the Spotify IDs for the artists
     * @return array
     */
    public function getArtists(array $artistIds): array
    {
        $params = [
            'ids' => $artistIds,
        ];

        return $this->resourceClient->get(self::ARTIST_URI, $params);
    }
}
