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
     * Client constructor.
     */
    public function __construct(
        public AlbumApiInterface $albumApi,
        public ArtistApiInterface $artistApi,
        public CategoryApiInterface $categoryApi,
        public EpisodeApiInterface $episodeApi,
        public GenreApiInterface $genreApi,
        public MarketApiInterface $marketApi,
        public PlayerApiInterface $playerApi,
        public PlaylistApiInterface $playlistApi,
        public SearchApiInterface $searchApi,
        public ShowApiInterface $showApi,
        public TrackApiInterface $trackApi,
        public UserApiInterface $userApi
    ) {
    }
}
