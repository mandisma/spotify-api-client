<?php

namespace Mandisma\SpotifyApiClient\Tests\Actions;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class BrowseApiTest extends ApiTestCase
{
    public function testPlaylistsWithCategory()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $categoryId = 'party';

        $playlists = $this->client->browseApi->getPlaylistsByCategory($categoryId);

        $this->assertNotEmpty($playlists);
    }

    public function testGetRecommendations()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('tracks')));

        $recommendations = $this->client->browseApi->getRecommendations(
            ['4NHQUGzhtTLFvgF5SZesLK'],
            ['classical'],
            ['0c6xIDDpzE81m2q797ordA']
        );

        $this->assertNotEmpty($recommendations);
    }

    public function testGetCategories()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('categories')));

        $categories = $this->client->browseApi->getCategories();

        $this->assertNotEmpty($categories);
    }

    public function testGetNewReleases()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('albums')));

        $releases = $this->client->browseApi->getNewReleases();

        $this->assertNotEmpty($releases);
    }

    public function testGetFeaturedPlaylists()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('playlists')));

        $playlists = $this->client->browseApi->getFeaturedPlaylists();

        $this->assertNotEmpty($playlists);
    }

    public function testGetCategory()
    {
        $this->mockHandler->append(new Response(200, [], load_fixture('category')));

        $categoryId = 'party';

        $category = $this->client->browseApi->getCategory($categoryId);

        $this->assertNotEmpty($category);
    }
}
