<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class EpisodeApi extends AbstractApi implements EpisodeApiInterface
{
    /**
     * URI suffix for the episode endpoint
     *
     * @var string
     */
    public const EPISODE_URI = '/v1/episodes';

    /**
     * {@inheritdoc}
     */
    public function getEpisode(string $episodeId, array $options = []): array
    {
        return $this->resourceClient->get(self::EPISODE_URI . "/$episodeId", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getEpisodes(array $episodesIds, array $options = []): array
    {
        $params = array_merge($options, [
            'ids' => $episodesIds,
        ]);

        return $this->resourceClient->get(self::EPISODE_URI, $params);
    }
}
