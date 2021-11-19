<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class GenreApi extends AbstractApi implements GenreApiInterface
{
    public function getSeeds(): array
    {
        return $this->resourceClient->get('/recommendations/available-genre-seeds');
    }
}
