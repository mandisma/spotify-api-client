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

final class Client implements ClientInterface
{
    /**
     * @var AlbumApiInterface
     */
    private $albumApi;

    /**
     * @var ArtistApiInterface
     */
    private $artistApi;

    /**
     * @var AuthenticationApiInterface
     */
    private $authenticationApi;

    /**
     * @var BrowseApiInterface
     */
    private $browseApi;

    /**
     * @var EpisodeApiInterface
     */
    private $episodeApi;

    /**
     * @var FollowApiInterface
     */
    private $followApi;

    /**
     * @var LibraryApiInterface
     */
    private $libraryApi;

    /**
     * @var PersonalizationApiInterface
     */
    private $personalizationApi;

    /**
     * @var PlayerApiInterface
     */
    private $playerApi;

    /**
     * @var PlaylistApiInterface
     */
    private $playlistApi;

    /**
     * @var SearchApiInterface
     */
    private $searchApi;

    /**
     * @var ShowApiInterface
     */
    private $showApi;

    /**
     * @var TrackApiInterface
     */
    private $trackApi;

    /**
     * @var UserProfileApiInterface
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
     * @param AlbumApiInterface $albumApi
     * @param ArtistApiInterface $artistApi
     * @param BrowseApiInterface $browseApi
     * @param EpisodeApiInterface $episodeApi
     * @param FollowApiInterface $followApi
     * @param LibraryApiInterface $libraryApi
     * @param PersonalizationApiInterface $personalizationApi
     * @param PlayerApiInterface $playerApi
     * @param PlaylistApiInterface $playlistApi
     * @param SearchApiInterface $searchApi
     * @param ShowApiInterface $showApi
     * @param TrackApiInterface $trackApi
     * @param UserProfileApiInterface $userProfileApi
     */
    public function __construct(
        AlbumApiInterface $albumApi,
        ArtistApiInterface $artistApi,
        AuthenticationApiInterface $authenticationApi,
        BrowseApiInterface $browseApi,
        EpisodeApiInterface $episodeApi,
        FollowApiInterface $followApi,
        LibraryApiInterface $libraryApi,
        PersonalizationApiInterface $personalizationApi,
        PlayerApiInterface $playerApi,
        PlaylistApiInterface $playlistApi,
        SearchApiInterface $searchApi,
        ShowApiInterface $showApi,
        TrackApiInterface $trackApi,
        UserProfileApiInterface $userProfileApi
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
     * {@inheritdoc}
     */
    public function getAlbumApi(): AlbumApiInterface
    {
        return $this->albumApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtistApi(): ArtistApiInterface
    {
        return $this->artistApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthenticationApi(): AuthenticationApiInterface
    {
        return $this->authenticationApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowseApi(): BrowseApiInterface
    {
        return $this->browseApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getEpisodeApi(): EpisodeApiInterface
    {
        return $this->episodeApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getFollowApi(): FollowApiInterface
    {
        return $this->followApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getLibraryApi(): LibraryApiInterface
    {
        return $this->libraryApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonalizationApi(): PersonalizationApiInterface
    {
        return $this->personalizationApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayerApi(): PlayerApiInterface
    {
        return $this->playerApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlaylistApi(): PlaylistApiInterface
    {
        return $this->playlistApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchApi(): SearchApiInterface
    {
        return $this->searchApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getShowApi(): ShowApiInterface
    {
        return $this->showApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getTrackApi(): TrackApiInterface
    {
        return $this->trackApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfileApi(): UserProfileApiInterface
    {
        return $this->userProfileApi;
    }
}
