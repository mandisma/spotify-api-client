<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\HttpClientInterface;

abstract class AbstractApi
{
    /**
     * @var HttpClientInterface
     */
    protected $resourceClient;

    /**
     * @param HttpClientInterface $resourceClient
     */
    public function __construct(HttpClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }
}
