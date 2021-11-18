<?php

use GuzzleHttp\Psr7\Response;

it('can remove current user saved albums', function () {
    mockHandler()->append(new Response(200, []));

    $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

    $removed = client()->libraryApi->removeCurrentUserSavedAlbums($albumsIds);

    $requestUri = '/v1/me/albums';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $albumsIds]);
    expect($removed)->toBeTrue();
});

it('can get current user saved tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracks = client()->libraryApi->getCurrentUserSavedTracks();

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can get current user saved albums', function () {
    mockHandler()->append(new Response(200, [], load_fixture('albums')));

    $albums = client()->libraryApi->getCurrentUserSavedAlbums();

    $requestUri = '/v1/me/albums';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($albums)->not->toBeEmpty();
});

it('can save current user albums', function () {
    mockHandler()->append(new Response(200, []));

    $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

    $saved = client()->libraryApi->saveCurrentUserAlbums($albumsIds);

    $requestUri = '/v1/me/albums';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $albumsIds]);
    expect($saved)->toBeTrue();
});

it('can save current user tracks', function () {
    mockHandler()->append(new Response(200, []));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $saved = client()->libraryApi->saveCurrentUserTracks($tracksIds);

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $tracksIds]);
    expect($saved)->toBeTrue();
});

it('can check current user saved albums', function () {
    mockHandler()->append(new Response(200, [], load_fixture('albums')));

    $albumsIds = ["4iV5W9uYEdYUVa79Axb7Rh", "1301WleyT98MSxVHPZCA6M"];

    $albums = client()->libraryApi->checkCurrentUserSavedAlbums($albumsIds);

    $requestUri = '/v1/me/albums/contains?' . http_build_query(['ids' => $albumsIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($albums)->not->toBeEmpty();
});

it('can remove current user saved tracks', function () {
    mockHandler()->append(new Response(200, []));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $removed = client()->libraryApi->removeCurrentUserSavedTracks($tracksIds);

    $requestUri = '/v1/me/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['ids' => $tracksIds]);
    expect($removed)->toBeTrue();
});

it('can check current user saved tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracksIds = ['4iV5W9uYEdYUVa79Axb7Rh', '1301WleyT98MSxVHPZCA6M'];

    $tracks = client()->libraryApi->checkCurrentUserSavedTracks($tracksIds);

    $requestUri = '/v1/me/tracks/contains?' . http_build_query(['ids' => $tracksIds]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});
