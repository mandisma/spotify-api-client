<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\PlaylistApi;

it('can add item', function () {
    mockHandler()->append(new Response(200, [], load_fixture('snapshot')));

    $playlistId = '7oi0w0SLbJ4YyjrOxhZbUv';

    $added = client()->playlistApi->addItem($playlistId, [
        'uris' => 'spotify:track:4iV5W9uYEdYUVa79Axb7Rh, spotify:track:1301WleyT98MSxVHPZCA6M,spotify:episode:512ojhOuo1ktJprKbVcKyQ',
    ]);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($added)->not->toBeEmpty();
});

it('can change details', function () {
    mockHandler()->append(new Response(200, [], load_fixture('search')));

    $playlistId = '6Df19VKaShrdWrAnHinwVO';

    $changed = client()->playlistApi->changeDetails($playlistId, [
        'name' => 'Playlist Name',
        'public' => true,
    ]);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($changed)->toEqual(true);
});

it('can create', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlist')));

    $userId = 'thelinmichael';
    $playlistName = 'New Playlist';

    $createdPlaylist = client()->playlistApi->create($userId, $playlistName, ['public' => true]);

    $requestUri = "/v1/users/${userId}/playlists";

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['public' => true, 'name' => $playlistName]);
    expect($createdPlaylist)->not->toBeEmpty();
});

it('can get current user playlists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $playlists = client()->playlistApi->getCurrentUserPlaylists();

    $requestUri = "/v1/me/playlists";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists['items'])->not->toBeEmpty();
});

it('can get user playlists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $userId = 'user001';

    $playlists = client()->playlistApi->getUserPlaylists($userId);

    $requestUri = "/v1/users/${userId}/playlists";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists['items'])->not->toBeEmpty();
});

it('can get playlist', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlist')));

    $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

    $playlist = client()->playlistApi->getPlaylist($playlistId);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlist['id'])->not->toBeEmpty();
});

it('can get cover image', function () {
    mockHandler()->append(new Response(200, [], load_fixture('cover')));

    $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

    $cover = client()->playlistApi->getCoverImage($playlistId);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/images";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($cover)->not->toBeEmpty();
});

it('can get items', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlist-items')));

    $playlistId = '59ZbFPES4DQwEjBpWHzrtC';

    $items = client()->playlistApi->getItems($playlistId);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($items['items'])->not->toBeEmpty();
});

it('can remove items', function () {
    mockHandler()->append(new Response(200, [], load_fixture('snapshot')));

    $tracks = [
        ["uri" => "spotify:track:4iV5W9uYEdYUVa79Axb7Rh"],
        ["uri" => "spotify:track:1301WleyT98MSxVHPZCA6M"],
        ["uri" => "spotify:episode:512ojhOuo1ktJprKbVcKyQ"],
    ];

    $playlistId = '71m0QB5fUFrnqfnxVerUup';

    $removed = client()->playlistApi->removeItems($playlistId, $tracks, ['snapshot' => 'snapshot']);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['snapshot' => 'snapshot', 'tracks' => $tracks]);
    expect($removed)->not->toBeEmpty();
});

it('can reorder items', function () {
    mockHandler()->append(new Response(200, [], load_fixture('snapshot')));

    $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

    $reordered = client()->playlistApi->reorderItems($playlistId, 0, 4, ['snapshot' => 'snapshot']);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['snapshot' => 'snapshot', 'range_start' => 0, 'insert_before' => 4]);
    expect($reordered)->not->toBeEmpty();
});

it('can replace items', function () {
    mockHandler()->append(new Response(200, []));

    $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

    $replaced = client()->playlistApi->replaceItems($playlistId);

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/tracks";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($replaced)->toEqual(true);
});

it('can upload cover', function () {
    mockHandler()->append(new Response(200, []));

    $playlistId = '0vXtvEeftmc2aVQD9QBWrQ';

    $uploaded = client()->playlistApi->uploadCover($playlistId, base64_encode('cover'));

    $requestUri = PlaylistApi::PLAYLIST_URI . "/${playlistId}/images";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($uploaded)->toEqual(true);
});

it('can get playlists with category', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $categoryId = 'party';

    $playlists = client()->playlistApi->getPlaylistsByCategory($categoryId);

    $requestUri = '/v1/browse/categories/' . $categoryId . '/playlists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists)->not->toBeEmpty();
});

it('can get featured playlists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('playlists')));

    $playlists = client()->playlistApi->getFeaturedPlaylists();

    $requestUri = '/v1/browse/featured-playlists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($playlists)->not->toBeEmpty();
});
