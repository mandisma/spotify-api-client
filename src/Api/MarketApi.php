<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class MarketApi extends AbstractApi implements MarketApiInterface
{
    public function getMarkets(): array
    {
        return $this->resourceClient->get('/v1/markets');
    }
}
