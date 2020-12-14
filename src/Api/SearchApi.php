<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class SearchApi extends AbstractApi implements SearchApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function search(string $query, string $type, array $options = []): array
    {
        $params = array_merge($options, [
            'q' => $query,
            'type' => $type,
        ]);

        return $this->resourceClient->get('/v1/search', $params);
    }
}
