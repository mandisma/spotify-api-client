<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface MarketApiInterface
{
    /**
     * Get Available Markets
     * Get the list of markets where Spotify is available.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-available-markets
     *
     * @return array
     */
    public function getMarkets(): array;
}
