<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class PlaylistApi extends AbstractApi implements PlaylistApiInterface
{
    /**
     * URI suffix for the playlist endpoint
     */
    public const PLAYER_URI = '/v1/playlists';

    /**
     * {@inheritdoc}
     */
    public function addItem(string $playlistId, array $options = []): array
    {
        return $this->resourceClient->post(self::PLAYER_URI . "/${playlistId}/tracks", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function changeDetails(string $playlistId, array $options = []): bool
    {
        $this->resourceClient->post(self::PLAYER_URI . "/${playlistId}", $options);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $userId, string $playlistName, array $options = []): array
    {
        $params = array_merge($options, [
            'name' => $playlistName,
        ]);

        return $this->resourceClient->post("/v1/users/${userId}/playlists", $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentUserPlaylists(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/playlists', $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPlaylists(string $userId, array $options = []): array
    {
        return $this->resourceClient->get("/v1/users/${userId}/playlists", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getPlaylist(string $playlistId, array $options = []): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . "/${playlistId}", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoverImage(string $playlistId): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . "/${playlistId}/images");
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(string $playlistId, array $options = []): array
    {
        return $this->resourceClient->get(self::PLAYER_URI . "/${playlistId}/tracks", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function removeItems(string $playlistId, array $tracks, array $options = []): array
    {
        $params = array_merge($options, [
            'tracks' => $tracks,
        ]);

        return $this->resourceClient->delete(self::PLAYER_URI . "/${playlistId}/tracks", $params);
    }

    /**
     * {@inheritdoc}
     */
    public function reorderItems(string $playlistId, int $rangeStart, int $insertBefore, array $options = []): array
    {
        $params = array_merge($options, [
            'range_start' => $rangeStart,
            'insert_before' => $insertBefore,
        ]);

        return $this->resourceClient->put(self::PLAYER_URI . "/${playlistId}/tracks", $params);
    }

    /**
     * {@inheritdoc}
     */
    public function replaceItems(string $playlistId, array $options = []): bool
    {
        $this->resourceClient->put(self::PLAYER_URI . "/${playlistId}/tracks", $options);

        return true;
    }

    /**
     * TODO:
     * Replace the image used to represent a specific playlist.
     * https://developer.spotify.com/documentation/web-api/reference/playlists/upload-custom-playlist-cover/
     *
     * @param string $playlistId    The Spotify ID for the playlist.
     * @param string $image Base64 encoded JPEG image data, maximum payload size is 256 KB
     */
    public function uploadCover(string $playlistId, string $image): bool
    {
        return $this->resourceClient->put(self::PLAYER_URI . "/${playlistId}/images");
    }
}
