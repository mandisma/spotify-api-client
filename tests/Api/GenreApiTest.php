<?php

use GuzzleHttp\Psr7\Response;

it('can return available genre seeds', function () {
    mockHandler()->append(new Response(200, [], load_fixture('genre-seeds')));

    $seeds = client()->genreApi->getSeeds();

    expect($seeds)
        ->toBeArray()
        ->toHaveKey('genres');
});
