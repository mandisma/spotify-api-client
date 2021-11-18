<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\FollowApi;

it('can is following users', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $usersIds = ['exampleuser01'];

    $followed = client()->followApi->isFollowingUsers($usersIds);

    $requestUri = '/v1/me/following/contains?' . http_build_query([
        'type' => FollowApi::TYPE_USER,
        'ids' => $usersIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(true);
});

it('can is following artists', function () {
    mockHandler()->append(new Response(200, [], json_encode([false])));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $followed = client()->followApi->isFollowingArtists($artistsIds);

    $requestUri = '/v1/me/following/contains?' . http_build_query([
        'type' => FollowApi::TYPE_ARTIST,
        'ids' => $artistsIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(false);
});

it('can follow users', function () {
    mockHandler()->append(new Response(204, []));

    $usersIds = ['exampleuser01'];

    $followed = client()->followApi->followUsers($usersIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'user', 'ids' => ['exampleuser01']]);
    expect($followed)->toBeTrue();
});

it('can follow artists', function () {
    mockHandler()->append(new Response(204, []));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $followed = client()->followApi->followArtists($artistsIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'artist', 'ids' => ['74ASZWbe4lXaubB36ztrGX']]);
    expect($followed)->toBeTrue();
});

it('can is following playlists', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';
    $usersIds = ['exampleuser01'];

    $followed = client()->followApi->isFollowingPlaylists($playlistId, $usersIds);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers/contains?' . http_build_query([
        'ids' => $usersIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(true);
});

it('can follow playlists', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

    $followed = client()->followApi->followPlaylists($playlistId);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toBeTrue();
});

it('can get user followed artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artists')));

    $artists = client()->followApi->getCurrentUserFollowedArtists('artist', ['limit' => 5]);

    $requestUri = '/v1/me/following?' . http_build_query(['limit' => 5, 'type' => 'artist']);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});

it('can unfollow artists', function () {
    mockHandler()->append(new Response(204, []));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $unfollowed = client()->followApi->unfollowArtists($artistsIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'artist', 'ids' => $artistsIds]);
    expect($unfollowed)->toBeTrue();
});

it('can unfollow users', function () {
    mockHandler()->append(new Response(204, []));

    $usersIds = ['exampleuser01'];

    $unfollowed = client()->followApi->unfollowUsers($usersIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'user', 'ids' => $usersIds]);
    expect($unfollowed)->toBeTrue();
});

it('can unfollow playlist', function () {
    mockHandler()->append(new Response(204, []));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

    $unfollowed = client()->followApi->unfollowPlaylist($playlistId);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($unfollowed)->toBeTrue();
});
