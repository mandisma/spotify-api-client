<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class UserProfileApi extends AbstractApi implements UserProfileApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCurrentUserProfile(): array
    {
        return $this->resourceClient->get('/v1/me');
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfile(string $userId): array
    {
        return $this->resourceClient->get("/v1/users/${userId}");
    }
}
