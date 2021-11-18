<?php

use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    mockHandler()->append(new Response(200, [], load_fixture('user-profile')));
});

it('can get current user profile', function () {
    $userProfile = client()->userProfileApi->getCurrentUserProfile();

    $requestUri = "/v1/me";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($userProfile)->not->toBeEmpty();
    expect($userProfile['id'])->toEqual('wizzler');
});

it('can get user profile', function () {
    $userId = 'wizzler';

    $userProfile = client()->userProfileApi->getUserProfile($userId);

    $requestUri = "/v1/users/$userId";

    expect(lastRequestUri())->toEqual($requestUri);
    expect($userProfile)->not->toBeEmpty();
    expect($userProfile['id'])->toEqual('wizzler');
});
