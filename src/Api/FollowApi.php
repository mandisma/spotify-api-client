<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class FollowApi extends AbstractApi implements FollowApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function isFollowingArtists(array $artistIds): array
    {
        return $this->isFollowingArtistsOrUsers('artist', $artistIds);
    }

    /**
     * {@inheritdoc}
     */
    public function isFollowingUsers(array $userIds): array
    {
        return $this->isFollowingArtistsOrUsers('user', $userIds);
    }

    /**
     * Check to see if the current user is following one or more artists or other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-current-user-follows/
     *
     * @param string $type The ID type: either artist or user
     * @param array $personIds List of the artist or the user Spotify IDs to check
     * @return array
     */
    private function isFollowingArtistsOrUsers(string $type, array $personIds): array
    {
        $params = [
            'type' => $type,
            'ids' => $personIds,
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
        return $this->followArtistsOrUsers('artist', $artistIds);
    }

    /**
     * {@inheritdoc}
     */
    public function followUsers(array $usersIds): bool
    {
        return $this->followArtistsOrUsers('user', $usersIds);
    }

    /**
     * Add the current user as a follower of one or more artists or other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-artists-users/
     *
     * @param string $type The ID type: either artist or user
     * @param array $ids List of the artist or the user Spotify IDs
     * @return boolean
     */
    private function followArtistsOrUsers(string $type, array $ids): bool
    {
        $params = [
            'type' => $type,
            'ids' => $ids,
        ];

        $this->resourceClient->put('/v1/me/following', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function followPlaylists(string $playlistId, array $options = []): bool
    {
        $this->resourceClient->put('v1/playlists/' . $playlistId . '/followers', $options);

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
        return $this->unfollowArtistsOrUsers('artist', $artistIds);
    }

    /**
     * {@inheritdoc}
     */
    public function unfollowUsers(array $userIds): bool
    {
        return $this->unfollowArtistsOrUsers('user', $userIds);
    }

    /**
     * Remove the current user as a follower of one or more artists or other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-artists-users/
     *
     * @param string $type The ID type: either artist or user
     * @param array $personIds List of the artist or the user Spotify IDs
     * @return bool
     */
    private function unfollowArtistsOrUsers(string $type, array $personIds): bool
    {
        $params = [
            'type' => $type,
            'ids' => $personIds,
        ];

        $this->resourceClient->delete('/v1/me/following', $params);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function unfollowPlaylist(string $playlistId): bool
    {
        $this->resourceClient->delete('/v1/playlists/' . $playlistId . '/followers');

        return true;
    }
}
