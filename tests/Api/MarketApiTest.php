<?php

use GuzzleHttp\Psr7\Response;

it('can get available markets', function () {
    mockHandler()->append(new Response(200, [], load_fixture('markets')));

    $markets = client()->marketApi->getMarkets();

    expect($markets)
        ->toBeArray()
        ->toHaveKey('markets');
});
