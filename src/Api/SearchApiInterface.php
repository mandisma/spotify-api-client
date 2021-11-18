<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface SearchApiInterface
{
    /**
     * Get Spotify Catalog information about artists, albums, tracks or playlists that match a keyword string
     * https://developer.spotify.com/documentation/web-api/reference/search/
     *
     * @param string $query Search query keywords and optional field filters and operators
     * @param string|array<string> $type List of item types to search across
     * @param array $options Optionnal parameters
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - int limit Maximum number of results to return
     * - int offset The index of the first result to return
     * - string includeExternal If include_external=audio is specified the response will include
     *                          any relevant audio content that is hosted externally.
     *
     * @return array
     */
    public function search(string $query, $type, array $options = []): array;
}
