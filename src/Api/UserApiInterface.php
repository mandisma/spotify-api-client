<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface UserApiInterface
{
    /**
     * Get detailed profile information about the current user (including the current user’s username).
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-current-users-profile
     *
     * @return array
     */
    public function getCurrentUserProfile(): array;

    /**
     * Get public profile information about a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-profile
     *
     * @param string $userId The user's Spotify user ID
     *
     * @return array
     */
    public function getUserProfile(string $userId): array;

    /**
     * Check to see if the current user is following one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-current-user-follows
     *
     * @param array $artistIds List of the artist Spotify IDs to check
     *
     * @return array
     */
    public function isFollowingArtists(array $artistIds): array;

    /**
     * Check to see if the current user is following one or more users
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-current-user-follows
     *
     * @param array $userIds List of the user Spotify IDs to check
     *
     * @return array
     */
    public function isFollowingUsers(array $userIds): array;

    /**
     * Check to see if one or more Spotify users are following a specified playlist
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/check-if-user-follows-playlist
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $userIds List of Spotify User IDs ;
     * the ids of the users that you want to check to see if they follow the playlist.
     *
     * @return array
     */
    public function isFollowingPlaylists(string $playlistId, array $userIds): array;

    /**
     * Add the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/follow-artists-users
     *
     * @param array $artistIds List of the artist or the user Spotify IDs
     */
    public function followArtists(array $artistIds): bool;

    /**
     * Add the current user as a follower of other Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/follow-artists-users
     *
     * @param array $usersIds List of the user Spotify IDs
     */
    public function followUsers(array $usersIds): bool;

    /**
     * Add the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/follow-playlist
     *
     * @param string $playlistId The Spotify ID of the playlist
     * @param array $options
     * - bool public If true the playlist will be included in user’s public playlists
     */
    public function followPlaylists(string $playlistId, array $options = []): bool;

    /**
     * Get the current user’s followed artists
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-followed
     *
     * @param string $type The ID type: currently only artist is supported
     * @param array $options
     * - int limit The maximum number of items to return
     * - string after The last artist ID retrieved from the previous request
     *
     * @return array
     */
    public function getCurrentUserFollowedArtists(string $type, array $options = []): array;

    /**
     * Remove the current user as a follower of one or more artists
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/unfollow-artists-users
     *
     * @param array $artistIds List of the artist Spotify IDs
     */
    public function unfollowArtists(array $artistIds): bool;

    /**
     * Remove the current user as a follower of one or more Spotify users
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/unfollow-artists-users
     *
     * @param array $userIds List of the user Spotify IDs
     */
    public function unfollowUsers(array $userIds): bool;

    /**
     * Remove the current user as a follower of a playlist
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/unfollow-playlist
     *
     * @param string $playlistId The Spotify ID of the playlist that is to be no longer followed
     */
    public function unfollowPlaylist(string $playlistId): bool;

    /**
     * Get the current user’s top artists based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-top-artists-and-tracks
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     *
     * @return array
     */
    public function getCurrentUserTopArtists(array $options = []): array;

    /**
     * Get the current user’s top tracks based on calculated affinity
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-top-artists-and-tracks
     *
     * @param array $options
     * - int limit The number of entities to return
     * - int offset The index of the first entity to return
     * - string time_range Over what time frame the affinities are computed
     *
     * @return array
     */
    public function getCurrentUserTopTracks(array $options = []): array;
}
