<?php

use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\CategoryApi;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Api\GenreApi;
use Mandisma\SpotifyApiClient\Api\MarketApi;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Api\SearchApi;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Api\TrackApi;
use Mandisma\SpotifyApiClient\Api\UserApi;

uses(\Mandisma\SpotifyApiClient\Tests\ApiTestCase::class);

test('get search api', function () {
    expect(client()->searchApi)->toBeInstanceOf(SearchApi::class);
});

test('get category api', function () {
    expect(client()->categoryApi)->toBeInstanceOf(CategoryApi::class);
});

test('get episode api', function () {
    expect(client()->episodeApi)->toBeInstanceOf(EpisodeApi::class);
});

test('get genre api', function () {
    expect(client()->genreApi)->toBeInstanceOf(GenreApi::class);
});

test('get market api', function () {
    expect(client()->marketApi)->toBeInstanceOf(MarketApi::class);
});

test('get player api', function () {
    expect(client()->playerApi)->toBeInstanceOf(PlayerApi::class);
});

test('get playlist api', function () {
    expect(client()->playerApi)->toBeInstanceOf(PlayerApi::class);
});

test('get artist api', function () {
    expect(client()->artistApi)->toBeInstanceOf(ArtistApi::class);
});

test('get user api', function () {
    expect(client()->userApi)->toBeInstanceOf(UserApi::class);
});

test('get album api', function () {
    expect(client()->albumApi)->toBeInstanceOf(AlbumApi::class);
});

test('get show api', function () {
    expect(client()->showApi)->toBeInstanceOf(ShowApi::class);
});

test('get track api', function () {
    expect(client()->trackApi)->toBeInstanceOf(TrackApi::class);
});
