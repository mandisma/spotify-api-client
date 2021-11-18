<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\AlbumApi;

function albumApi(): AlbumApi
{
    return client()->albumApi;
}

it('can get album', function () {
    $albumId = '0sNOF9WDwhWunNAHPD3Baj';

    mockHandler()->append(new Response(200, [], load_fixture('album')));

    $album = albumApi()->getAlbum($albumId);

    $requestUri = AlbumApi::ALBUM_URI . '/' . $albumId;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($album)->not->toBeEmpty();
    expect($album['id'])->toEqual($albumId);
});

it('can get albums', function () {
    $albumIds = [
        '0sNOF9WDwhWunNAHPD3Baj',
        '41MnTivkwTO3UUJ8DrqEJJ',
        '6JWc4iAiJ9FjyK0B59ABb4',
        '6UXCm6bOO4gFlDQZV5yL37',
    ];

    mockHandler()->append(new Response(200, [], load_fixture('album')));

    $albums = albumApi()->getAlbums($albumIds, ['market' => 'FR']);

    $requestUri = AlbumApi::ALBUM_URI . '?' . http_build_query(['market' => 'FR', 'ids' => $albumIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($albums)->not->toBeEmpty();
});

it('can get tracks', function () {
    $albumId = '0sNOF9WDwhWunNAHPD3Baj';

    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $response = albumApi()->getTracks($albumId);

    $requestUri = AlbumApi::ALBUM_URI . '/' . $albumId . '/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($response)->not->toBeEmpty();
});
