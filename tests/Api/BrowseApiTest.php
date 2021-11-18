<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\BrowseApi;

it('can playlists with category', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $categoryId = 'party';

    $playlists = client()->browseApi->getPlaylistsByCategory($categoryId);

    $requestUri = BrowseApi::BROWSE_URI . '/categories/' . $categoryId . '/playlists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists)->not->toBeEmpty();
});

it('can get recommendations', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $recommendations = client()->browseApi->getRecommendations(
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

    expect(lastRequestUri())->toEqual($requestUri);
    expect($recommendations)->not->toBeEmpty();
});

it('can get categories', function () {
    mockHandler()->append(new Response(200, [], load_fixture('categories')));

    $categories = client()->browseApi->getCategories();

    $requestUri = BrowseApi::BROWSE_URI . '/categories';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($categories)->not->toBeEmpty();
});

it('can get new releases', function () {
    mockHandler()->append(new Response(200, [], load_fixture('albums')));

    $releases = client()->browseApi->getNewReleases();

    $requestUri = BrowseApi::BROWSE_URI . '/new-releases';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($releases)->not->toBeEmpty();
});

it('can get featured playlists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $playlists = client()->browseApi->getFeaturedPlaylists();

    $requestUri = BrowseApi::BROWSE_URI . '/featured-playlists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists)->not->toBeEmpty();
});

it('can get category', function () {
    mockHandler()->append(new Response(200, [], load_fixture('category')));

    $categoryId = 'party';

    $category = client()->browseApi->getCategory($categoryId);

    $requestUri = BrowseApi::BROWSE_URI . '/categories/' . $categoryId;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($category)->not->toBeEmpty();
});
