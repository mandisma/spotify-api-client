<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

interface UserProfileApiInterface
{
    /**
     * Get detailed profile information about the current user (including the current user’s username).
     * https://developer.spotify.com/documentation/web-api/reference/users-profile/get-current-users-profile/
     *
     * @return array
     */
    public function getCurrentUserProfile(): array;

    /**
     * Get public profile information about a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/users-profile/get-users-profile/
     *
     * @param string $userId The user's Spotify user ID
     *
     * @return array
     */
    public function getUserProfile(string $userId): array;
}
