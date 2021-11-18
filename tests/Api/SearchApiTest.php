<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;

it('can search artists', function () {
    mockHandler()->append(new Response(200, [], load_fixture('search')));

    $search = client()->searchApi->search('tania bowra', 'artist', ['market' => 'FR']);

    $requestUri = "/v1/search?" . http_build_query([
        'market' => 'FR',
        'q' => 'tania bowra',
        'type' => 'artist',
    ], '', '&', PHP_QUERY_RFC3986);

    expect(lastRequestUri())->toEqual($requestUri);
    expect($search['artists'])->not->toBeEmpty();
});
