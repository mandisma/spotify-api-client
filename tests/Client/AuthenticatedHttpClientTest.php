<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Exception\ResponseException;

function authenticatedHttpClient()
{
    return new AuthenticatedHttpClient(httpClient(), getAuthorization());
}

test('request has authorization', function () {
    mockHandler()->append(new Response(200, [], json_encode(['foo' => 'bar'])));

    authenticatedHttpClient()->get('test');

    expect(mockHandler()->getLastRequest()->hasHeader('Authorization'))->toBeTrue();
    expect(lastResponse()->getStatusCode())->toEqual(200);
});

it('can make get request', function () {
    mockHandler()->append(new Response(201, [], json_encode(['foo' => 'bar'])));

    $data = authenticatedHttpClient()->get('test');

    expect($data)->toBeArray();
    expect($data)->toHaveKey('foo');
    expect(lastResponse()->getStatusCode())->toEqual(201);
});

it('can make post request', function () {
    mockHandler()->append(new Response(200, [], json_encode(['foo' => 'bar'])));

    $data = authenticatedHttpClient()->post('test');

    expect($data)->toBeArray();
    expect($data)->toHaveKey('foo');
});

it('can make put request', function () {
    mockHandler()->append(new Response(200));

    $data = authenticatedHttpClient()->put('test');

    expect($data)->toBeArray();
    expect($data)->toBeEmpty();
});

it('can make delete request', function () {
    mockHandler()->append(new Response(200));

    $data = authenticatedHttpClient()->delete('test');

    expect($data)->toBeArray();
    expect($data)->toBeEmpty();
});

it('return exception when response has unsuccessful status code', function () {
    $this->expectException(ResponseException::class);
    $this->expectExceptionMessage('Test error');

    mockHandler()->append(new Response(208, [], 'Test error'));

    authenticatedHttpClient()->get('test-error');
});
