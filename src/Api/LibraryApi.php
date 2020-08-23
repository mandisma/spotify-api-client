<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

final class LibraryApi extends AbstractApi
{
    /**
     * Check if one or more albums is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/check-users-saved-albums/
     *
     * @param array $albumsIds List of the Spotify IDs for the albums
     * @return array
     */
    public function checkCurrentUserSavedAlbums(array $albumsIds): array
    {
        $params = [
            'ids' => $albumsIds,
        ];

        return $this->resourceClient->get('/v1/me/albums/contains', $params);
    }

    /**
     * Check if one or more tracks is already saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/check-users-saved-tracks/
     *
     * @param array $trackIds List of the Spotify IDs for the tracks
     * @return array
     */
    public function checkCurrentUserSavedTracks(array $trackIds): array
    {
        $params = [
            'ids' => $trackIds,
        ];

        return $this->resourceClient->get('/v1/me/tracks/contains', $params);
    }

    /**
     * Get a list of the albums saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/get-users-saved-albums/
     *
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getCurrentUserSavedAlbums(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/albums', $options);
    }

    /**
     * Get a list of the songs saved in the current Spotify user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/get-users-saved-tracks/
     *
     * @param array $options
     * - int limit The maximum number of objects to return
     * - int offset The index of the first object to return
     * - string market An ISO 3166-1 alpha-2 country code or the string from_token
     * @return array
     */
    public function getCurrentUserSavedTracks(array $options = []): array
    {
        return $this->resourceClient->get('/v1/me/tracks', $options);
    }

    /**
     * Remove one or more albums from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/remove-albums-user/
     *
     * @param array $albumIds List of the Albums Spotify IDs
     * @return bool
     */
    public function removeCurrentUserSavedAlbums(array $albumIds): bool
    {
        $params = [
            'ids' => $albumIds,
        ];

        $this->resourceClient->delete('/v1/me/albums', $params);

        return true;
    }

    /**
     * Remove one or more tracks from the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/remove-tracks-user/
     *
     * @param array $trackIds List of the tracks Spotify IDs
     * @return bool
     */
    public function removeCurrentUserSavedTracks(array $trackIds): bool
    {
        $params = [
            'ids' => $trackIds,
        ];

        $this->resourceClient->delete('/v1/me/tracks', $params);

        return true;
    }

    /**
     * Save one or more albums to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/save-albums-user/
     *
     * @param array $albumIds List of the album Spotify IDs
     * @return boolean
     */
    public function saveCurrentUserAlbums(array $albumIds): bool
    {
        $params = [
            'ids' => $albumIds
        ];

        $this->resourceClient->put('/v1/me/albums', $params);

        return true;
    }

    /**
     * Save one or more tracks to the current user’s ‘Your Music’ library
     * https://developer.spotify.com/documentation/web-api/reference/library/save-tracks-user/
     *
     * @param array $trackIds List of the track Spotify IDs
     * @return boolean
     */
    public function saveCurrentUserTracks(array $trackIds): bool
    {
        $params = [
            'ids' => $trackIds,
        ];

        $this->resourceClient->put('/v1/me/tracks', $params);

        return true;
    }
}
