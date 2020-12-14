<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class ShowApi extends AbstractApi implements ShowApiInterface
{
    /**
     * URI suffix for the show endpoint
     *
     * @var string
     */
    public const SHOW_URI = '/v1/shows';

    /**
     * {@inheritdoc}
     */
    public function getShow(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getShows(array $showsIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $showsIds,
        ]);

        return $this->resourceClient->get(self::SHOW_URI, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getShowEpisodes(string $showId, array $options = []): array
    {
        return $this->resourceClient->get(self::SHOW_URI . "/${showId}/episodes", $options);
    }
}
