<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface FollowApiInterface
{
    /**
     * Check to see if the current user is following one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-current-user-follows/
     *
     * @param array $artistIds List of the artist Spotify IDs to check
     * @return array
     */
    public function isFollowingArtists(array $artistIds): array;

    /**
     * Check to see if the current user is following one or more users
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-current-user-follows/
     *
     * @param array $userIds List of the user Spotify IDs to check
     * @return array
     */
    public function isFollowingUsers(array $userIds): array;

    /**
     * Check to see if one or more Spotify users are following a specified playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/check-user-following-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $userIds List of Spotify User IDs ;
     * the ids of the users that you want to check to see if they follow the playlist.
     * @return array
     */
    public function isFollowingPlaylists(string $playlistId, array $userIds): array;

    /**
     * Add the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-artists-users/
     *
     * @param array $artistIds List of the artist or the user Spotify IDs
     * @return boolean
     */
    public function followArtists(array $artistIds): bool;

    /**
     * Add the current user as a follower of other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-artists-users/
     *
     * @param array $usersIds List of the user Spotify IDs
     * @return boolean
     */
    public function followUsers(array $usersIds): bool;

    /**
     * Add the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/follow-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $options
     * - bool public If true the playlist will be included in user’s public playlists
     * @return boolean
     */
    public function followPlaylists(string $playlistId, array $options = []): bool;

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
    public function getCurrentUserFollowedArtists(string $type, array $options = []): array;

    /**
     * Remove the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-artists-users/
     *
     * @param array $artistIds List of the artist Spotify IDs
     * @return bool
     */
    public function unfollowArtists(array $artistIds): bool;

    /**
     * Remove the current user as a follower of one or more Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-artists-users/
     *
     * @param array $userIds List of the user Spotify IDs
     * @return bool
     */
    public function unfollowUsers(array $userIds): bool;

    /**
     * Remove the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/follow/unfollow-playlist/
     *
     * @param string $playlistId The Spotify ID of the playlist that is to be no longer followed
     * @return boolean
     */
    public function unfollowPlaylist(string $playlistId): bool;
}
