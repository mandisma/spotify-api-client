<?php

use Mandisma\SpotifyApiClient\Client;
use Mandisma\SpotifyApiClient\ClientBuilder;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;

it('can build authenticated client', function () {
    $authorization = $this->getMockBuilder(AuthorizationInterface::class)->getMock();

    $client = (new ClientBuilder())->build($authorization);

    expect($client)->toBeInstanceOf(Client::class);
});

it('can build with default http client', function () {
    $clientBuilder = new ClientBuilder();

    $reflectionClass = new ReflectionClass($clientBuilder);
    $reflectionProperty = $reflectionClass->getProperty('httpClient');
    $reflectionProperty->setAccessible(true);
    $httpClient = $reflectionProperty->getValue(new ClientBuilder());

    expect($httpClient->getConfig('base_uri'))->toEqual(Client::API_URL);
    expect($httpClient->getConfig('http_errors'))->toEqual(false);
    expect($httpClient->getConfig('headers'))->toEqual([
        'Accept' => 'application/json',
        'User-Agent' => 'GuzzleHttp/7',
    ]);
});
