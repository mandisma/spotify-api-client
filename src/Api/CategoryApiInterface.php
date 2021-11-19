<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface CategoryApiInterface
{
    /**
     * Get a single category used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-category
     *
     * @param string $categoryId The Spotify category ID for the category
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - string locale The desired language consisting of an ISO 639-1 language code
     *                  and an ISO 3166-1 alpha-2 country code
     *
     * @return array
     */
    public function getCategory(string $categoryId, array $options = []): array;

    /**
     * Get a list of categories used to tag items in Spotify (on, for example, the Spotify player’s “Browse” tab)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-categories
     *
     * @param array $options
     * - string country A country: an ISO 3166-1 alpha-2 country code
     * - string locale The desired language, consisting of an ISO 639-1 language code
     *                 and an ISO 3166-1 alpha-2 country code
     * - int limit The maximum number of categories to return
     * - int offset The index of the first item to return
     *
     * @return array
     */
    public function getCategories(array $options = []): array;
}
