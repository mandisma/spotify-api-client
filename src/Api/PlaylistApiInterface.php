<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface PlaylistApiInterface
{
    /**
     * Add one or more items to a user’s playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/add-tracks-to-playlist
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param array $options
     * - string|array uris A comma-separated list of Spotify URIs to add, can be track or episode URIs.
     * - int position The position to insert the items, a zero-based index.
     *
     * @return array
     */
    public function addItem(string $playlistId, array $options = []): array;

    /**
     * Change a playlist’s name and public/private state. (The user must, of course, own the playlist.)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/change-playlist-details
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param array $options
     * - string name The new name for the playlist, for example "My New Playlist Title".
     * - bool public If true the playlist will be public, if false it will be private.
     * - bool collaborative  If true , the playlist will become collaborative and other users will be able to modify
     *                       the playlist in their Spotify client.
     * - string description Value for playlist description as displayed in Spotify Clients and in the Web API.
     */
    public function changeDetails(string $playlistId, array $options = []): bool;

    /**
     * Create a playlist for a Spotify user. (The playlist will be empty until you add tracks.)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/create-playlist
     *
     * @param string $userId The user’s Spotify user ID.
     * @param string $playlistName The name for the new playlist, for example "Your Coolest Playlist" .
     * @param array $options
     * - bool public If true the playlist will be public, if false it will be private.
     * - bool collaborative  If true , the playlist will become collaborative and other users will be able to modify
     *                       the playlist in their Spotify client.
     * - string description Value for playlist description as displayed in Spotify Clients and in the Web API.
     *
     * @return array
     */
    public function create(string $userId, string $playlistName, array $options = []): array;

    /**
     * Get a list of the playlists owned or followed by the current Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-list-of-current-users-playlists
     *
     * @param array $options
     * - integer limit  The maximum number of playlists to return. Default: 20. Minimum: 1. Maximum: 50.
     * - integer offset The index of the first playlist to return. Default: 0 (the first object).
     *
     * @return array
     */
    public function getCurrentUserPlaylists(array $options = []): array;

    /**
     * Get a list of the playlists owned or followed by a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-list-users-playlists
     *
     * @param string $userId The user’s Spotify user ID.
     * @param array $options
     * - integer limit  The maximum number of playlists to return. Default: 20. Minimum: 1. Maximum: 50.
     * - integer offset The index of the first playlist to return. Default: 0 (the first object).
     *
     * @return array
     */
    public function getUserPlaylists(string $userId, array $options = []): array;

    /**
     * Get a playlist owned by a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-playlist
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param array $options
     * - string fields Filters for the query: a comma-separated list of the fields to return.
     *      If omitted, all fields are returned.
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - string additional_types A comma-separated list of item types that your client supports.
     *      Valid types are: track and episode.
     *
     * @return array
     */
    public function getPlaylist(string $playlistId, array $options = []): array;

    /**
     *  Get the current image associated with a specific playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-playlist-cover
     *
     * @param string $playlistId The Spotify ID for the playlist.
     *
     * @return array
     */
    public function getCoverImage(string $playlistId): array;

    /**
     * Get full details of the tracks or episodes of a playlist owned by a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-playlists-tracks
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param array $options
     * - string fields Filters for the query: a comma-separated list of the fields to return.
     *      If omitted, all fields are returned.
     * - integer limit  The maximum number of playlists to return. Default: 20. Minimum: 1. Maximum: 50.
     * - integer offset The index of the first playlist to return. Default: 0 (the first object).
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * - string additional_types A comma-separated list of item types that your client supports.
     *      Valid types are: track and episode.
     *
     * @return array
     */
    public function getItems(string $playlistId, array $options = []): array;

    /**
     * Remove one or more items from a user’s playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/remove-tracks-playlist
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param array $tracks An array of objects containing Spotify URIs of the tracks and episodes to remove.
     * @param array $options
     * - string snapshot The playlist’s snapshot ID against which you want to make the changes.
     *
     * @return array
     */
    public function removeItems(string $playlistId, array $tracks, array $options = []): array;

    /**
     * Reorder an item or a group of items in a playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/reorder-or-replace-playlists-tracks
     *
     * @param string $playlistId The Spotify ID for the playlist.
     * @param int $rangeStart The position of the first item to be reordered.
     * @param int $insertBefore The position where the items should be inserted.
     * @param array $options
     * - integer range_length The amount of items to be reordered. Defaults to 1 if not set.
     * - string snapshot The playlist’s snapshot ID against which you want to make the changes.
     *
     * @return array
     */
    public function reorderItems(string $playlistId, int $rangeStart, int $insertBefore, array $options = []): array;

    /**
     * Replace all the items in a playlist, overwriting its existing items.
     * This powerful request can be useful for replacing items, re-ordering existing items, or clearing the playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/reorder-or-replace-playlists-tracks
     *
     * @param string $playlistId    The Spotify ID for the playlist.
     * @param array $options
     * - array|string uris A list of Spotify URIs to set, can be track or episode URIs.
     */
    public function replaceItems(string $playlistId, array $options = []): bool;

    /**
     * Replace the image used to represent a specific playlist.
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/upload-custom-playlist-cover
     *
     * @param string $playlistId    The Spotify ID for the playlist.
     * @param string $image Base64 encoded JPEG image data, maximum payload size is 256 KB
     */
    public function uploadCover(string $playlistId, string $image): bool;

    /**
     * Get a list of Spotify playlists tagged with a particular category
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-a-categories-playlists
     *
     * @param string $categoryId The Spotify category ID for the category
     * @param array $options
     * - integer limit The maximum number of items to return
     * - integer offset The index of the first item to return
     * - string country A country: an ISO 3166-1 alpha-2 country code
     *
     * @return array
     */
    public function getPlaylistsByCategory(string $categoryId, array $options = []): array;

    /**
     * Get a list of Spotify featured playlists (shown, for example, on a Spotify player’s ‘Browse’ tab)
     * https://developer.spotify.com/documentation/web-api/reference/#/operations/get-featured-playlists
     *
     * @param array $options
     * - string locale The desired language, consisting of an ISO 639-1 language code
     *                  and an ISO 3166-1 alpha-2 country code
     * - string country A country: an ISO 3166-1 alpha-2 country code
     *                    the user’s local time to get results tailored for that specific date and time in the day
     * - string timestamp A timestamp in ISO 8601 format: yyyy-MM-ddTHH:mm:ss. Use this parameter to specify
     * - int limit The maximum number of items to return
     * - int offset The index of the first item to return
     *
     * @return array
     */
    public function getFeaturedPlaylists(array $options = []): array;
}
