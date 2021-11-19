<?php

use GuzzleHttp\Psr7\Response;

it('can get categories', function () {
    mockHandler()->append(new Response(200, [], load_fixture('categories')));

    $categories = client()->categoryApi->getCategories();

    $requestUri = '/v1/browse/categories';

    expect(lastRequestUri())->toEqual($requestUri);
    expect($categories)->not->toBeEmpty();
});

it('can get category', function () {
    mockHandler()->append(new Response(200, [], load_fixture('category')));

    $categoryId = 'party';

    $category = client()->categoryApi->getCategory($categoryId);

    $requestUri = '/v1/browse/categories/' . $categoryId;

    expect(lastRequestUri())->toEqual($requestUri);
    expect($category)->not->toBeEmpty();
});
