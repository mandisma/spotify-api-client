<?php

namespace Mandisma\SpotifyApiClient\Tests;

use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\BrowseApi;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Api\FollowApi;
use Mandisma\SpotifyApiClient\Api\LibraryApi;
use Mandisma\SpotifyApiClient\Api\PersonalizationApi;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Api\SearchApi;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Api\TrackApi;
use Mandisma\SpotifyApiClient\Api\UserProfileApi;

class ClientTest extends ApiTestCase
{
    public function testGetSearchApi()
    {
        $searchApi = $this->client->searchApi;
        $this->assertInstanceOf(SearchApi::class, $searchApi);
    }

    public function testGetBrowseApi()
    {
        $browseApi = $this->client->browseApi;
        $this->assertInstanceOf(BrowseApi::class, $browseApi);
    }

    public function testGetEpisodeApi()
    {
        $episodeApi = $this->client->episodeApi;
        $this->assertInstanceOf(EpisodeApi::class, $episodeApi);
    }

    public function testGetPlayerApi()
    {
        $playerApi = $this->client->playerApi;
        $this->assertInstanceOf(PlayerApi::class, $playerApi);
    }

    public function testGetFollowApi()
    {
        $followApi = $this->client->followApi;
        $this->assertInstanceOf(FollowApi::class, $followApi);
    }

    public function testGetPlaylistApi()
    {
        $playerApi = $this->client->playerApi;
        $this->assertInstanceOf(PlayerApi::class, $playerApi);
    }

    public function testGetArtistApi()
    {
        $artistApi = $this->client->artistApi;
        $this->assertInstanceOf(ArtistApi::class, $artistApi);
    }

    public function testGetUserProfileApi()
    {
        $userProfileApi = $this->client->userProfileApi;
        $this->assertInstanceOf(UserProfileApi::class, $userProfileApi);
    }

    public function testGetAlbumApi()
    {
        $albumApi = $this->client->albumApi;
        $this->assertInstanceOf(AlbumApi::class, $albumApi);
    }

    public function testGetPersonalizationApi()
    {
        $personalizationApi = $this->client->personalizationApi;
        $this->assertInstanceOf(PersonalizationApi::class, $personalizationApi);
    }

    public function testGetLibraryApi()
    {
        $libraryApi = $this->client->libraryApi;
        $this->assertInstanceOf(LibraryApi::class, $libraryApi);
    }

    public function testGetShowApi()
    {
        $showApi = $this->client->showApi;
        $this->assertInstanceOf(ShowApi::class, $showApi);
    }

    public function testGetTrackApi()
    {
        $trackApi = $this->client->trackApi;
        $this->assertInstanceOf(TrackApi::class, $trackApi);
    }
}
