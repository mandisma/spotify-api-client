<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface PlayerApiInterface
{
    /**
     * Get information about a user’s available devices
     * https://developer.spotify.com/documentation/web-api/reference/player/get-a-users-available-devices/
     *
     * @return array
     */
    public function getAvailableDevices(): array;

    /**
     * Get information about the user’s current playback state, including track, track progress, and active device
     * https://developer.spotify.com/documentation/web-api/reference/player/get-information-about-the-users-current-playback/
     *
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getPlayback(array $options = []): array;

    /**
     * Get tracks from the current user’s recently played tracks.
     * https://developer.spotify.com/documentation/web-api/reference/player/get-recently-played/
     *
     * - int limit The maximum number of items to return
     * - int after Returns all items after (but not including) this cursor position
     * - int before Returns all items before (but not including) this cursor position
     * @return array
     */
    public function getRecentlyPlayedTracks(array $options = []): array;

    /**
     * Get the object currently being played on the user’s Spotify account
     * https://developer.spotify.com/documentation/web-api/reference/player/get-the-users-currently-playing-track/
     *
     * @param array $options
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getCurrentlyPlayingTrack(array $options = []): array;

    /**
     * Pause playback on the user’s account
     * https://developer.spotify.com/documentation/web-api/reference/player/pause-a-users-playback/
     *
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function pausePlayback(array $options = []): bool;

    /**
     * Seeks to the given position in the user’s currently playing track
     * https://developer.spotify.com/documentation/web-api/reference/player/seek-to-position-in-currently-playing-track/
     *
     * @param integer $position The position in milliseconds to seek to. Must be a positive number
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function seekToPosition(int $position, array $options = []): bool;

    /**
     * Set the repeat mode for the user’s playback. Options are repeat-track, repeat-context, and off.
     * https://developer.spotify.com/documentation/web-api/reference/player/set-repeat-mode-on-users-playback/
     *
     * @param string $state track, context or off
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function setRepeatMode(string $state, array $options = []): bool;

    /**
     * Set the volume for the user’s current playback device.
     * https://developer.spotify.com/documentation/web-api/reference/player/set-volume-for-users-playback/
     *
     * @param integer $volume The volume to set. Must be a value from 0 to 100 inclusive.
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function setVolume(int $volume, array $options = []): bool;

    /**
     * Skips to next track in the user’s queue.
     * https://developer.spotify.com/documentation/web-api/reference/player/skip-users-playback-to-next-track/
     *
     * @param array $options
     * - string devide_id The id of the device this command is targeting
     * @return boolean
     */
    public function skipToNextTrack(array $options = []): bool;

    /**
     * Skips to previous track in the user’s queue.
     * https://developer.spotify.com/documentation/web-api/reference/player/skip-users-playback-to-previous-track/
     *
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function skipToPreviousTrack(array $options = []): bool;

    /**
     * Start a new context or resume current playback on the user’s active device.
     * https://developer.spotify.com/documentation/web-api/reference/player/start-a-users-playback/
     *
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function startPlayback(array $options = []): bool;

    /**
     * Toggle shuffle on or off for user’s playback.
     * https://developer.spotify.com/documentation/web-api/reference/player/toggle-shuffle-for-users-playback/
     *
     * @param bool $state If true shuffle user’s playback
     * @param array $options
     * - string device_id The id of the device this command is targeting
     * @return boolean
     */
    public function toggleShuffle(bool $state, array $options = []): bool;

    /**
     * Start a new context or resume current playback on the user’s active device.
     * https://developer.spotify.com/documentation/web-api/reference/player/transfer-a-users-playback/
     *
     * @param array $deviceIds A JSON array containing the ID of the device on which
     *                          playback should be started/transferred.
     * @param array $options
     * - bool play If true: ensure playback happens on new device.
     * @return boolean
     */
    public function transferPlayback(array $deviceIds, array $options = []): bool;
}
