<?php

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

uses(\Mandisma\SpotifyApiClient\Tests\ApiTestCase::class);

test('get search api', function () {
    expect(client()->searchApi)->toBeInstanceOf(SearchApi::class);
});

test('get browse api', function () {
    expect(client()->browseApi)->toBeInstanceOf(BrowseApi::class);
});

test('get episode api', function () {
    expect(client()->episodeApi)->toBeInstanceOf(EpisodeApi::class);
});

test('get player api', function () {
    expect(client()->playerApi)->toBeInstanceOf(PlayerApi::class);
});

test('get follow api', function () {
    expect(client()->followApi)->toBeInstanceOf(FollowApi::class);
});

test('get playlist api', function () {
    expect(client()->playerApi)->toBeInstanceOf(PlayerApi::class);
});

test('get artist api', function () {
    expect(client()->artistApi)->toBeInstanceOf(ArtistApi::class);
});

test('get user profile api', function () {
    expect(client()->userProfileApi)->toBeInstanceOf(UserProfileApi::class);
});

test('get album api', function () {
    expect(client()->albumApi)->toBeInstanceOf(AlbumApi::class);
});

test('get personalization api', function () {
    expect(client()->personalizationApi)->toBeInstanceOf(PersonalizationApi::class);
});

test('get library api', function () {
    expect(client()->libraryApi)->toBeInstanceOf(LibraryApi::class);
});

test('get show api', function () {
    expect(client()->showApi)->toBeInstanceOf(ShowApi::class);
});

test('get track api', function () {
    expect(client()->trackApi)->toBeInstanceOf(TrackApi::class);
});
