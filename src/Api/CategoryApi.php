<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class CategoryApi extends AbstractApi implements CategoryApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCategory(string $categoryId, array $options = []): array
    {
        return $this->resourceClient->get('/v1/browse/categories/' . $categoryId, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories(array $options = []): array
    {
        return $this->resourceClient->get('/v1/browse/categories', $options);
    }
}
