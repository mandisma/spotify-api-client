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
use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = (new ClientBuilder())->buildByCredentials('client_id', 'client_secret', 'redirect_uri');
    }

    public function testGetSearchApi()
    {
        $searchApi = $this->client->getSearchApi();
        $this->assertInstanceOf(SearchApi::class, $searchApi);
    }

    public function testGetBrowseApi()
    {
        $browseApi = $this->client->getBrowseApi();
        $this->assertInstanceOf(BrowseApi::class, $browseApi);
    }

    public function testGetEpisodeApi()
    {
        $episodeApi = $this->client->getEpisodeApi();
        $this->assertInstanceOf(EpisodeApi::class, $episodeApi);
    }

    public function testGetPlayerApi()
    {
        $playerApi = $this->client->getPlayerApi();
        $this->assertInstanceOf(PlayerApi::class, $playerApi);
    }

    public function testGetFollowApi()
    {
        $followApi = $this->client->getFollowApi();
        $this->assertInstanceOf(FollowApi::class, $followApi);
    }

    public function testGetPlaylistApi()
    {
        $playerApi = $this->client->getPlayerApi();
        $this->assertInstanceOf(PlayerApi::class, $playerApi);
    }

    public function testGetArtistApi()
    {
        $artistApi = $this->client->getArtistApi();
        $this->assertInstanceOf(ArtistApi::class, $artistApi);
    }

    public function testGetUserProfileApi()
    {
        $userProfileApi = $this->client->getUserProfileApi();
        $this->assertInstanceOf(UserProfileApi::class, $userProfileApi);
    }

    public function testGetAlbumApi()
    {
        $albumApi = $this->client->getAlbumApi();
        $this->assertInstanceOf(AlbumApi::class, $albumApi);
    }

    public function testGetPersonalizationApi()
    {
        $personalizationApi = $this->client->getPersonalizationApi();
        $this->assertInstanceOf(PersonalizationApi::class, $personalizationApi);
    }

    public function testGetLibraryApi()
    {
        $libraryApi = $this->client->getLibraryApi();
        $this->assertInstanceOf(LibraryApi::class, $libraryApi);
    }

    public function testGetShowApi()
    {
        $showApi = $this->client->getShowApi();
        $this->assertInstanceOf(ShowApi::class, $showApi);
    }

    public function testGetTrackApi()
    {
        $trackApi = $this->client->getTrackApi();
        $this->assertInstanceOf(TrackApi::class, $trackApi);
    }
}
