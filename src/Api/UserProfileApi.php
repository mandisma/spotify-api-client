<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class UserProfileApi extends AbstractApi
{
    /**
     * Get detailed profile information about the current user (including the current user’s username).
     * https://developer.spotify.com/documentation/web-api/reference/users-profile/get-current-users-profile/
     *
     * @return array
     */
    public function getCurrentUserProfile(): array
    {
        return $this->resourceClient->get('/v1/me');
    }

    /**
     * Get public profile information about a Spotify user.
     * https://developer.spotify.com/documentation/web-api/reference/users-profile/get-users-profile/
     *
     * @param string $userId The user's Spotify user ID
     * @return array
     */
    public function getUserProfile(string $userId): array
    {
        return $this->resourceClient->get("/v1/users/${userId}");
    }
}
