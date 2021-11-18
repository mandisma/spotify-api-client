<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use Mandisma\SpotifyApiClient\Client;

uses(\Mandisma\SpotifyApiClient\Tests\ApiTestCase::class)->in('Api', 'Client');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function client(): Client
{
    return test()->getClient();
}

function httpClient(): GuzzleHttpClient
{
    return test()->getHttpClient();
}

function getAuthorization()
{
    return test()->getAuthorization();
}

function mockHandler(): MockHandler
{
    return test()->getMockHandler();
}

function lastRequestUri()
{
    return test()->getLastRequest()->getUri();
}

function lastRequestJson(): array
{
    return json_decode(test()->getLastRequestBody()->getContents(), true);
}

function lastResponse()
{
    $container = test()->getContainer();

    return end($container)['response'];
}
