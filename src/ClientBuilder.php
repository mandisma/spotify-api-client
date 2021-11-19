<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\CategoryApi;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Api\GenreApi;
use Mandisma\SpotifyApiClient\Api\MarketApi;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Api\PlaylistApi;
use Mandisma\SpotifyApiClient\Api\SearchApi;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Api\TrackApi;
use Mandisma\SpotifyApiClient\Api\UserApi;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;

final class ClientBuilder
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(?HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? $this->defaultHttpClient();
    }

    /**
     * Build a client from an authorization object
     */
    public function build(AuthorizationInterface $authorization): Client
    {
        $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $authorization);

        return new Client(
            new AlbumApi($authenticatedHttpClient),
            new ArtistApi($authenticatedHttpClient),
            new CategoryApi($authenticatedHttpClient),
            new EpisodeApi($authenticatedHttpClient),
            new GenreApi($authenticatedHttpClient),
            new MarketApi($authenticatedHttpClient),
            new PlayerApi($authenticatedHttpClient),
            new PlaylistApi($authenticatedHttpClient),
            new SearchApi($authenticatedHttpClient),
            new ShowApi($authenticatedHttpClient),
            new TrackApi($authenticatedHttpClient),
            new UserApi($authenticatedHttpClient)
        );
    }

    /**
     * Get default http client.
     *
     * @return GuzzleHttpClient
     */
    private function defaultHttpClient(): GuzzleHttpClient
    {
        return new GuzzleHttpClient([
            'base_uri' => Client::API_URL,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }
}
