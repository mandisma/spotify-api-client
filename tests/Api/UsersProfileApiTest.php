<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Mandisma\SpotifyApiClient\Tests\ApiTestCase;

class UsersProfileApiTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mockHandler->append(new Response(200, [], load_fixture('user-profile')));
    }

    public function testGetCurrentUserProfile()
    {
        $userProfile = $this->client->userProfileApi->getCurrentUserProfile();

        $requestUri = "/v1/me";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($userProfile);
        $this->assertEquals('wizzler', $userProfile['id']);
    }

    public function testGetUserProfile()
    {
        $userId = 'wizzler';

        $userProfile = $this->client->userProfileApi->getUserProfile($userId);

        $requestUri = "/v1/users/$userId";

        $this->assertEquals($requestUri, $this->getLastRequestUri());
        $this->assertNotEmpty($userProfile);
        $this->assertEquals('wizzler', $userProfile['id']);
    }
}
