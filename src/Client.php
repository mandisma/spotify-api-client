<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use Mandisma\SpotifyApiClient\Api\AlbumApiInterface;
use Mandisma\SpotifyApiClient\Api\ArtistApiInterface;
use Mandisma\SpotifyApiClient\Api\CategoryApiInterface;
use Mandisma\SpotifyApiClient\Api\EpisodeApiInterface;
use Mandisma\SpotifyApiClient\Api\GenreApiInterface;
use Mandisma\SpotifyApiClient\Api\MarketApiInterface;
use Mandisma\SpotifyApiClient\Api\PlayerApiInterface;
use Mandisma\SpotifyApiClient\Api\PlaylistApiInterface;
use Mandisma\SpotifyApiClient\Api\SearchApiInterface;
use Mandisma\SpotifyApiClient\Api\ShowApiInterface;
use Mandisma\SpotifyApiClient\Api\TrackApiInterface;
use Mandisma\SpotifyApiClient\Api\UserApiInterface;

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
     * @var CategoryApiInterface
     */
    public $categoryApi;

    /**
     * @var EpisodeApiInterface
     */
    public $episodeApi;

    /**
     * @var GenreApiInterface
     */
    public $genreApi;

    /**
     * @var MarketApiInterface
     */
    public $marketApi;

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
     * @var UserApiInterface
     */
    public $userApi;

    /**
     * Client constructor.
     */
    public function __construct(
        AlbumApiInterface $albumApi,
        ArtistApiInterface $artistApi,
        CategoryApiInterface $categoryApi,
        EpisodeApiInterface $episodeApi,
        GenreApiInterface $genreApi,
        MarketApiInterface $marketApi,
        PlayerApiInterface $playerApi,
        PlaylistApiInterface $playlistApi,
        SearchApiInterface $searchApi,
        ShowApiInterface $showApi,
        TrackApiInterface $trackApi,
        UserApiInterface $userApi
    ) {
        $this->albumApi = $albumApi;
        $this->artistApi = $artistApi;
        $this->categoryApi = $categoryApi;
        $this->episodeApi = $episodeApi;
        $this->genreApi = $genreApi;
        $this->marketApi = $marketApi;
        $this->playerApi = $playerApi;
        $this->playlistApi = $playlistApi;
        $this->searchApi = $searchApi;
        $this->showApi = $showApi;
        $this->trackApi = $trackApi;
        $this->userApi = $userApi;
    }
}
