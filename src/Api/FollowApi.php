<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class FollowApi extends AbstractApi implements FollowApiInterface
{
    public const TYPE_ARTIST = 'artist';
    public const TYPE_USER = 'user';

    /**
     * {@inheritdoc}
     */
    public function isFollowingArtists(array $artistIds): array
    {
        $params = [
            'type' => self::TYPE_ARTIST,
            'ids' => $artistIds,
        ];

        return $this->resourceClient->get('/v1/me/following/contains', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function isFollowingUsers(array $userIds): array
    {
        $params = [
            'type' => self::TYPE_USER,
            'ids' => $userIds,
        ];

        return $this->resourceClient->get('/v1/me/following/contains', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function isFollowingPlaylists(string $playlistId, array $userIds): array
    {
        $params = [
            'ids' => $userIds,
        ];

        return $this->resourceClient->get('/v1/playlists/' . $playlistId . '/followers/contains', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function followArtists(array $artistIds): bool
    {
        $params = [
            'type' => self::TYPE_ARTIST,
            'ids' => $artistIds,
        ];

        $this->resourceClient->put('/v1/me/following', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function followUsers(array $usersIds): bool
    {
        $params = [
            'type' => self::TYPE_USER,
            'ids' => $usersIds,
        ];

        $this->resourceClient->put('/v1/me/following', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function followPlaylists(string $playlistId, array $options = []): bool
    {
        $this->resourceClient->put('/v1/playlists/' . $playlistId . '/followers', $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentUserFollowedArtists(string $type, array $options = []): array
    {
        $params = array_merge($options, [
            'type' => $type,
        ]);

        return $this->resourceClient->get('/v1/me/following', $params);
    }

    /**
     * {@inheritdoc}
     */
    public function unfollowArtists(array $artistIds): bool
    {
        $params = [
            'type' => self::TYPE_ARTIST,
            'ids' => $artistIds,
        ];

        $this->resourceClient->delete('/v1/me/following', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function unfollowUsers(array $userIds): bool
    {
        $params = [
            'type' => self::TYPE_USER,
            'ids' => $userIds,
        ];

        $this->resourceClient->delete('/v1/me/following', $params);

        return true;
    }

    public function unfollowPlaylist(string $playlistId): bool
    {
        $this->resourceClient->delete('/v1/playlists/' . $playlistId . '/followers');

        return true;
    }
}
