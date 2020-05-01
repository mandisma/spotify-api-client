<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

final class FollowApi
{
    /**
     * @var ResourceClient
     */
    private $resourceClient;

    /**
     * @param ResourceClient $resourceClient
     */
    public function __construct(ResourceClient $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * Check to see if the current user is following one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-current-user-follows/
     *
     * @param array $artistIds List of the artist Spotify IDs to check
     * @return array
     */
    public function isFollowingArtists(array $artistIds): array
    {
        return $this->isFollowingArtistsOrUsers('artist', $artistIds);
    }

    /**
     * Check to see if the current user is following one or more users
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-current-user-follows/
     *
     * @param array $userIds List of the user Spotify IDs to check
     * @return array
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
     * Check to see if one or more Spotify users are following a specified playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-user-following-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $userIds List of Spotify User IDs ;
     * the ids of the users that you want to check to see if they follow the playlist.
     * @return array
     */
    public function isFollowingPlaylists(string $playlistId, array $userIds): array
    {
        $params = [
            'ids' => $userIds,
        ];

        return $this->resourceClient->get('/v1/playlists/' . $playlistId . '/followers/contains', $params);
    }

    /**
     * Add the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-artists-users/
     *
     * @param array $artistIds List of the artist or the user Spotify IDs
     * @return boolean
     */
    public function followArtists(array $artistIds): bool
    {
        return $this->followArtistsOrUsers('artist', $artistIds);
    }

    /**
     * Add the current user as a follower of other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-artists-users/
     *
     * @param array $usersIds List of the user Spotify IDs
     * @return boolean
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
     * Add the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $options
     * - bool public If true the playlist will be included in user’s public playlists
     * @return boolean
     */
    public function followPlaylists(string $playlistId, array $options = []): bool
    {
        $this->resourceClient->put('v1/playlists/' . $playlistId . '/followers', $options);

        return true;
    }

    /**
     * Get the current user’s followed artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/get-followed/
     *
     * @param string $type The ID type: currently only artist is supported
     * @param array $options
     * - int limit The maximum number of items to return
     * - string after The last artist ID retrieved from the previous request
     * @return array
     */
    public function getCurrentUserFollowedArtists(string $type, array $options = []): array
    {
        $params = array_merge($options, [
            'type' => $type,
        ]);

        return $this->resourceClient->get('/v1/me/following', $params);
    }

    /**
     * Remove the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-artists-users/
     *
     * @param array $artistIds List of the artist Spotify IDs
     * @return bool
     */
    public function unfollowArtists(array $artistIds): bool
    {
        return $this->unfollowArtistsOrUsers('artist', $artistIds);
    }

    /**
     * Remove the current user as a follower of one or more Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-artists-users/
     *
     * @param array $userIds List of the user Spotify IDs
     * @return bool
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
     * Remove the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist that is to be no longer followed
     * @return boolean
     */
    public function unfollowPlaylist(string $playlistId): bool
    {
        $this->resourceClient->delete('/v1/playlists/' . $playlistId . '/followers');

        return true;
    }
}
