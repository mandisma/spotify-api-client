<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClient;

abstract class AbstractApi
{
    /**
     * @var ResourceClient
     */
    protected $resourceClient;

    /**
     * @param ResourceClient $resourceClient
     */
    public function __construct(ResourceClient $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }
}
