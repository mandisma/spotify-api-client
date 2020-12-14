<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Tests;

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
        $userProfile = $this->client->getUserProfileApi()->getCurrentUserProfile();

        $this->assertNotEmpty($userProfile);
        $this->assertEquals('wizzler', $userProfile['id']);
    }

    public function testGetUserProfile()
    {
        $userProfile = $this->client->getUserProfileApi()->getUserProfile('wizzler');

        $this->assertNotEmpty($userProfile);
        $this->assertEquals('wizzler', $userProfile['id']);
    }
}
