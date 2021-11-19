<?php

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Api\UserApi;

it('can get current user profile', function () {
    mockHandler()->append(new Response(200, [], load_fixture('user-profile')));
    $userProfile = client()->userApi->getCurrentUserProfile();

    $requestUri = "/v1/me";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($userProfile)->not->toBeEmpty();
    expect($userProfile['id'])->toEqual('wizzler');
});

it('can get user profile', function () {
    mockHandler()->append(new Response(200, [], load_fixture('user-profile')));
    $userId = 'wizzler';

    $userProfile = client()->userApi->getUserProfile($userId);

    $requestUri = "/v1/users/$userId";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($userProfile)->not->toBeEmpty();
    expect($userProfile['id'])->toEqual('wizzler');
});

it('can get user top tracks', function () {
    mockHandler()->append(new Response(200, [], load_fixture('tracks')));

    $tracks = client()->userApi->getCurrentUserTopTracks();

    $requestUri = '/v1/me/top/tracks';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($tracks)->not->toBeEmpty();
});

it('can get user top artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artists')));

    $artists = client()->userApi->getCurrentUserTopArtists();

    $requestUri = '/v1/me/top/artists';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});

it('can is following users', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $usersIds = ['exampleuser01'];

    $followed = client()->userApi->isFollowingUsers($usersIds);

    $requestUri = '/v1/me/following/contains?' . http_build_query([
        'type' => UserApi::TYPE_USER,
        'ids' => $usersIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(true);
});

it('can is following artists', function () {
    mockHandler()->append(new Response(200, [], json_encode([false])));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $followed = client()->userApi->isFollowingArtists($artistsIds);

    $requestUri = '/v1/me/following/contains?' . http_build_query([
        'type' => UserApi::TYPE_ARTIST,
        'ids' => $artistsIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(false);
});

it('can follow users', function () {
    mockHandler()->append(new Response(204, []));

    $usersIds = ['exampleuser01'];

    $followed = client()->userApi->followUsers($usersIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'user', 'ids' => ['exampleuser01']]);
    expect($followed)->toBeTrue();
});

it('can follow artists', function () {
    mockHandler()->append(new Response(204, []));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $followed = client()->userApi->followArtists($artistsIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'artist', 'ids' => ['74ASZWbe4lXaubB36ztrGX']]);
    expect($followed)->toBeTrue();
});

it('can check if users are following playlists', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';
    $usersIds = ['exampleuser01'];

    $followed = $this->client->userApi->isFollowingPlaylists($playlistId, $usersIds);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers/contains?' . http_build_query([
        'ids' => $usersIds,
    ]);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toContain(true);
});

it('can follow playlists', function () {
    mockHandler()->append(new Response(200, [], json_encode([true])));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

    $followed = client()->userApi->followPlaylists($playlistId);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($followed)->toBeTrue();
});

it('can get user followed artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('artists')));

    $artists = client()->userApi->getCurrentUserFollowedArtists('artist', ['limit' => 5]);

    $requestUri = '/v1/me/following?' . http_build_query(['limit' => 5, 'type' => 'artist']);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($artists)->not->toBeEmpty();
});

it('can unfollow artists', function () {
    mockHandler()->append(new Response(204, []));

    $artistsIds = ['74ASZWbe4lXaubB36ztrGX'];

    $unfollowed = client()->userApi->unfollowArtists($artistsIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'artist', 'ids' => $artistsIds]);
    expect($unfollowed)->toBeTrue();
});

it('can unfollow users', function () {
    mockHandler()->append(new Response(204, []));

    $usersIds = ['exampleuser01'];

    $unfollowed = client()->userApi->unfollowUsers($usersIds);

    $requestUri = '/v1/me/following';

    expect(lastRequestUri())->toEqual($requestUri);
    expect(lastRequestJson())->toEqual(['type' => 'user', 'ids' => $usersIds]);
    expect($unfollowed)->toBeTrue();
});

it('can unfollow playlist', function () {
    mockHandler()->append(new Response(204, []));

    $playlistId = '2v3iNvBX8Ay1Gt2uXtUKUT';

    $unfollowed = client()->userApi->unfollowPlaylist($playlistId);

    $requestUri = '/v1/playlists/' . $playlistId . '/followers';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($unfollowed)->toBeTrue();
});
