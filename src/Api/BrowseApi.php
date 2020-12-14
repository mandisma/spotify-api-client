<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class BrowseApi extends AbstractApi implements BrowseApiInterface
{
    /**
     * URI suffix for the browse endpoint
     *
     * @var string
     */
    public const BROWSE_URI = '/v1/browse';

    /**
     * {@inheritdoc}
     */
    public function getCategory(string $categoryId, array $options = []): array
    {
        return $this->resourceClient->get(self::BROWSE_URI . '/categories/' . $categoryId, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getPlaylistsByCategory(string $categoryId, array $options = []): array
    {
        return $this->resourceClient->get(self::BROWSE_URI . '/categories/' . $categoryId . '/playlists', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories(array $options = []): array
    {
        return $this->resourceClient->get(self::BROWSE_URI . '/categories', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getFeaturedPlaylists(array $options = []): array
    {
        return $this->resourceClient->get(self::BROWSE_URI . '/featured-playlists', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getNewReleases(array $options = []): array
    {
        return $this->resourceClient->get(self::BROWSE_URI . '/new-releases', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getRecommendations(array $options = []): array
    {
        return $this->resourceClient->get('/recommendations', $options);
    }
}
