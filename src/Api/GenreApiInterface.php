<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface GenreApiInterface
{
    /**
     * Get Available Genre Seeds
     * Retrieve a list of available genres seed parameter values for recommendations.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-recommendation-genres
     *
     * @return array
     */
    public function getSeeds(): array;
}
