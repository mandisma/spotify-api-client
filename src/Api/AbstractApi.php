<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient\Api;

use Mandisma\SpotifyApiClient\Client\ResourceClientInterface;

abstract class AbstractApi
{
    public function __construct(protected ResourceClientInterface $resourceClient)
    {
    }
}
