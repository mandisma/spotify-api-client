<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use Mandisma\SpotifyApiClient\Api\AlbumApiInterface;
use Mandisma\SpotifyApiClient\Api\ArtistApiInterface;
use Mandisma\SpotifyApiClient\Api\AuthenticationApiInterface;
use Mandisma\SpotifyApiClient\Api\BrowseApiInterface;
use Mandisma\SpotifyApiClient\Api\EpisodeApiInterface;
use Mandisma\SpotifyApiClient\Api\FollowApiInterface;
use Mandisma\SpotifyApiClient\Api\LibraryApiInterface;
use Mandisma\SpotifyApiClient\Api\PersonalizationApiInterface;
use Mandisma\SpotifyApiClient\Api\PlayerApiInterface;
use Mandisma\SpotifyApiClient\Api\PlaylistApiInterface;
use Mandisma\SpotifyApiClient\Api\SearchApiInterface;
use Mandisma\SpotifyApiClient\Api\ShowApiInterface;
use Mandisma\SpotifyApiClient\Api\TrackApiInterface;
use Mandisma\SpotifyApiClient\Api\UserProfileApiInterface;

interface ClientInterface
{
    /**
     * @return AlbumApiInterface
     */
    public function getAlbumApi(): AlbumApiInterface;

    /**
     * @return ArtistApiInterface
     */
    public function getArtistApi(): ArtistApiInterface;

    /**
     * @return AuthenticationApiInterface
     */
    public function getAuthenticationApi(): AuthenticationApiInterface;

    /**
     * @return BrowseApiInterface
     */
    public function getBrowseApi(): BrowseApiInterface;

    /**
     * @return EpisodeApiInterface
     */
    public function getEpisodeApi(): EpisodeApiInterface;

    /**
     * @return FollowApiInterface
     */
    public function getFollowApi(): FollowApiInterface;

    /**
     * @return LibraryApiInterface
     */
    public function getLibraryApi(): LibraryApiInterface;

    /**
     * @return PersonalizationApiInterface
     */
    public function getPersonalizationApi(): PersonalizationApiInterface;

    /**
     * @return PlayerApiInterface
     */
    public function getPlayerApi(): PlayerApiInterface;

    /**
     * @return PlaylistApiInterface
     */
    public function getPlaylistApi(): PlaylistApiInterface;

    /**
     * @return SearchApiInterface
     */
    public function getSearchApi(): SearchApiInterface;

    /**
     * @return ShowApiInterface
     */
    public function getShowApi(): ShowApiInterface;

    /**
     * @return TrackApiInterface
     */
    public function getTrackApi(): TrackApiInterface;

    /**
     * @return UserProfileApiInterface
     */
    public function getUserProfileApi(): UserProfileApiInterface;
}
