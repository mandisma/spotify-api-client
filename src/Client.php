<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use Mandisma\SpotifyApiClient\Api\AlbumApiInterface;
use Mandisma\SpotifyApiClient\Api\ArtistApiInterface;
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

final class Client
{
    /**
     * The Spotify API URI
     */
    public const API_URL = 'https://api.spotify.com';

    /**
     * @var AlbumApiInterface
     */
    public $albumApi;

    /**
     * @var ArtistApiInterface
     */
    public $artistApi;

    /**
     * @var BrowseApiInterface
     */
    public $browseApi;

    /**
     * @var EpisodeApiInterface
     */
    public $episodeApi;

    /**
     * @var FollowApiInterface
     */
    public $followApi;

    /**
     * @var LibraryApiInterface
     */
    public $libraryApi;

    /**
     * @var PersonalizationApiInterface
     */
    public $personalizationApi;

    /**
     * @var PlayerApiInterface
     */
    public $playerApi;

    /**
     * @var PlaylistApiInterface
     */
    public $playlistApi;

    /**
     * @var SearchApiInterface
     */
    public $searchApi;

    /**
     * @var ShowApiInterface
     */
    public $showApi;

    /**
     * @var TrackApiInterface
     */
    public $trackApi;

    /**
     * @var UserProfileApiInterface
     */
    public $userProfileApi;

    /**
     * Client constructor.
     */
    public function __construct(
        AlbumApiInterface $albumApi,
        ArtistApiInterface $artistApi,
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
}
