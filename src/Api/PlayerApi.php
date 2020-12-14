<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class PlayerApi extends AbstractApi implements PlayerApiInterface
{
    /**
     * URI suffix for the player endpoint
     *
     * @var string
     */
    public const PLAYER_URI = '/v1/artists';

    /**
     * {@inheritdoc}
     */
    public function getAvailableDevices(): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . '/devices');
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayback(array $options = []): array
    {
        return $this->resourceClient->get(self::PLAYER_URI, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentlyPlayedTracks(array $options = []): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . '/recently-played', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentlyPlayingTrack(array $options = []): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . '/currently-playing', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function pausePlayback(array $options = []): bool
    {
        $this->resourceClient->put(self::PLAYER_URI . '/pause', $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function seekToPosition(int $position, array $options = []): bool
    {
        $params = array_merge($options, [
            'position_ms' => $position,
        ]);

        $this->resourceClient->put(self::PLAYER_URI . '/seek', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function setRepeatMode(string $state, array $options = []): bool
    {
        $params = array_merge($options, [
            'state' => $state,
        ]);

        $this->resourceClient->put(self::PLAYER_URI . '/repeat', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function setVolume(int $volume, array $options = []): bool
    {
        $params = array_merge($options, [
            'volume_percent' => $volume,
        ]);

        $this->resourceClient->put(self::PLAYER_URI . '/volume', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function skipToNextTrack(array $options = []): bool
    {
        $this->resourceClient->put(self::PLAYER_URI . '/next', $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function skipToPreviousTrack(array $options = []): bool
    {
        $this->resourceClient->put(self::PLAYER_URI . '/previous', $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function startPlayback(array $options = []): bool
    {
        $this->resourceClient->put(self::PLAYER_URI . '/play', $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function toggleShuffle(bool $state, array $options = []): bool
    {
        $params = array_merge($options, [
            'state' => $state,
        ]);

        $this->resourceClient->put(self::PLAYER_URI . '/shuffle', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function transferPlayback(array $deviceIds, array $options = []): bool
    {
        $params = array_merge($options, [
            'device_ids' => $deviceIds,
        ]);

        $this->resourceClient->put(self::PLAYER_URI, $params);

        return true;
    }
}
