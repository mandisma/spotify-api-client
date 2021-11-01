<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\BrowseApi;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class BrowseApiTest extends ApiTestCase
{
    public function testPlaylistsWithCategory()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $categoryId = 'party';

        $playlists = $this->client->browseApi->getPlaylistsByCategory($categoryId);

        $requestUri = BrowseApi::BROWSE_URI . '/categories/' . $categoryId . '/playlists';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playlists);
    }

    public function testGetRecommendations()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $recommendations = $this->client->browseApi->getRecommendations(
            ['4NHQUGzhtTLFvgF5SZesLK'],
            ['classical'],
            ['0c6xIDDpzE81m2q797ordA'],
            [
                'market' => 'FR',
            ]
        );

        $requestUri = '/v1/recommendations?' . http_build_query([
            'market' => 'FR',
            'seed_artists' => '4NHQUGzhtTLFvgF5SZesLK',
            'seed_genres' => 'classical',
            'seed_tracks' => '0c6xIDDpzE81m2q797ordA',
        ]);

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($recommendations);
    }

    public function testGetCategories()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('categories')));

        $categories = $this->client->browseApi->getCategories();

        $requestUri = BrowseApi::BROWSE_URI . '/categories';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($categories);
    }

    public function testGetNewReleases()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $releases = $this->client->browseApi->getNewReleases();

        $requestUri = BrowseApi::BROWSE_URI . '/new-releases';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($releases);
    }

    public function testGetFeaturedPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $playlists = $this->client->browseApi->getFeaturedPlaylists();

        $requestUri = BrowseApi::BROWSE_URI . '/featured-playlists';

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($playlists);
    }

    public function testGetCategory()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('category')));

        $categoryId = 'party';

        $category = $this->client->browseApi->getCategory($categoryId);

        $requestUri = BrowseApi::BROWSE_URI . '/categories/' . $categoryId;

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($category);
    }
}
