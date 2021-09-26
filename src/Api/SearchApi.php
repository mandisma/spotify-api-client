<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class SearchApi extends AbstractApi implements SearchApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function search(string $query, $type, array $options = []): array
    {
        $type = is_array($type) ? $type : [$type];

        $params = array_merge($options, [
            'q' => $query,
            'type' => implode(',', $type),
        ]);

        return $this->resourceClient->get('/v1/search', $params);
    }
}
