<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\ArtistApi;

function artistApi()
{
    return client()->artistApi;
}

it('can get artist related artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artists')));

    $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

    $artists = artistApi()->getRelatedArtists($artistId);

    $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/related-artists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});

it('can get artist albums', function () {
    mockHandler()->append(new Response(200, [], load_fixture('albums')));

    $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

    $albums = artistApi()->getAlbums($artistId);

    $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/albums';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($albums)->not->toBeEmpty();
});

it('can get artist', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artist')));

    $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

    $artist = artistApi()->getArtist($artistId);

    $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artist)->not->toBeEmpty();
});

it('can get artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('albums')));

    $artistsIds = ['0oSGxfWSnnOXhD2fKuz2Gy', '3dBVyJ7JuOMt4GE9607Qin'];

    $artists = artistApi()->getArtists($artistsIds);

    $requestUri = ArtistApi::ARTIST_URI . '?' . http_build_query(['ids' => $artistsIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});

it('can get artist top tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $artistId = '0OdUWJ0sBjDrqHygGUXeCF';

    $tracks = artistApi()->getTopTracks($artistId, 'FR');

    $requestUri = ArtistApi::ARTIST_URI . '/' . $artistId . '/top-tracks?country=FR';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});
