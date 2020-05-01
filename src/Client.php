<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
use Mandisma\SpotifyApiClient\Api\BrowseApi;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Api\FollowApi;
use Mandisma\SpotifyApiClient\Api\LibraryApi;
use Mandisma\SpotifyApiClient\Api\PersonalizationApi;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Api\PlaylistApi;
use Mandisma\SpotifyApiClient\Api\SearchApi;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Api\TrackApi;
use Mandisma\SpotifyApiClient\Api\UserProfileApi;

final class Client
{
    /**
     * @var AlbumApi
     */
    private $albumApi;

    /**
     * @var ArtistApi
     */
    private $artistApi;

    /**
     * @var AuthenticationApi
     */
    private $authenticationApi;

    /**
     * @var BrowseApi
     */
    private $browseApi;

    /**
     * @var EpisodeApi
     */
    private $episodeApi;

    /**
     * @var FollowApi
     */
    private $followApi;

    /**
     * @var LibraryApi
     */
    private $libraryApi;

    /**
     * @var PersonalizationApi
     */
    private $personalizationApi;

    /**
     * @var PlayerApi
     */
    private $playerApi;

    /**
     * @var PlaylistApi
     */
    private $playlistApi;

    /**
     * @var SearchApi
     */
    private $searchApi;

    /**
     * @var ShowApi
     */
    private $showApi;

    /**
     * @var TrackApi
     */
    private $trackApi;

    /**
     * @var UserProfileApi
     */
    private $userProfileApi;

    /**
     * The Spotify API URI
     *
     * @var string
     */
    public const API_URL = 'https://api.spotify.com';

    /**
     * Client constructor.
     * @param AlbumApi $albumApi
     * @param ArtistApi $artistApi
     * @param BrowseApi $browseApi
     * @param EpisodeApi $episodeApi
     * @param FollowApi $followApi
     * @param LibraryApi $libraryApi
     * @param PersonalizationApi $personalizationApi
     * @param PlayerApi $playerApi
     * @param PlaylistApi $playlistApi
     * @param SearchApi $searchApi
     * @param ShowApi $showApi
     * @param TrackApi $trackApi
     * @param UserProfileApi $userProfileApi
     */
    public function __construct(
        AlbumApi $albumApi,
        ArtistApi $artistApi,
        AuthenticationApi $authenticationApi,
        BrowseApi $browseApi,
        EpisodeApi $episodeApi,
        FollowApi $followApi,
        LibraryApi $libraryApi,
        PersonalizationApi $personalizationApi,
        PlayerApi $playerApi,
        PlaylistApi $playlistApi,
        SearchApi $searchApi,
        ShowApi $showApi,
        TrackApi $trackApi,
        UserProfileApi $userProfileApi
    ) {
        $this->albumApi = $albumApi;
        $this->artistApi = $artistApi;
        $this->authenticationApi = $authenticationApi;
        $this->browseApi = $browseApi;
        $this->episodeApi = $episodeApi;
        $this->followApi = $followApi;
        $this->libraryApi = $libraryApi;
        $this->personalizationApi = $personalizationApi;
        $this->playerApi = $playerApi;
        $this->playlistApi = $playlistApi;
        $this->searchApi = $searchApi;
        $this->showApi = $showApi;
        $this->trackApi = $trackApi;
        $this->userProfileApi = $userProfileApi;
    }

    /**
     * @return AlbumApi
     */
    public function getAlbumApi(): AlbumApi
    {
        return $this->albumApi;
    }

    /**
     * @return ArtistApi
     */
    public function getArtistApi(): ArtistApi
    {
        return $this->artistApi;
    }

    /**
     * @return AuthenticationApi
     */
    public function getAuthenticationApi(): AuthenticationApi
    {
        return $this->authenticationApi;
    }

    /**
     * @return BrowseApi
     */
    public function getBrowseApi(): BrowseApi
    {
        return $this->browseApi;
    }

    /**
     * @return EpisodeApi
     */
    public function getEpisodeApi(): EpisodeApi
    {
        return $this->episodeApi;
    }

    /**
     * @return FollowApi
     */
    public function getFollowApi(): FollowApi
    {
        return $this->followApi;
    }

    /**
     * @return LibraryApi
     */
    public function getLibraryApi(): LibraryApi
    {
        return $this->libraryApi;
    }

    /**
     * @return PersonalizationApi
     */
    public function getPersonalizationApi(): PersonalizationApi
    {
        return $this->personalizationApi;
    }

    /**
     * @return PlayerApi
     */
    public function getPlayerApi(): PlayerApi
    {
        return $this->playerApi;
    }

    /**
     * @return PlaylistApi
     */
    public function getPlaylistApi(): PlaylistApi
    {
        return $this->playlistApi;
    }

    /**
     * @return SearchApi
     */
    public function getSearchApi(): SearchApi
    {
        return $this->searchApi;
    }

    /**
     * @return ShowApi
     */
    public function getShowApi(): ShowApi
    {
        return $this->showApi;
    }

    /**
     * @return TrackApi
     */
    public function getTrackApi(): TrackApi
    {
        return $this->trackApi;
    }

    /**
     * @return UserProfileApi
     */
    public function getUserProfileApi(): UserProfileApi
    {
        return $this->userProfileApi;
    }
}
