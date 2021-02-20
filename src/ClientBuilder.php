<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\BrowseApi;
use Mandisma\SpotifyApiClient\Api\EpisodeApi;
use Mandisma\SpotifyApiClient\Api\FollowApi;
use Mandisma\SpotifyApiClient\Api\LibraryApi;
use Mandisma\SpotifyApiClient\Api\PersonalizationApi;
use Mandisma\SpotifyApiClient\Api\PlayerApi;
use Mandisma\SpotifyApiClient\Api\PlaylistApi;
use Mandisma\SpotifyApiClient\Api\SearchApi;
use Mandisma\SpotifyApiClient\Api\ShowApi;
use Mandisma\SpotifyApiClient\Api\TrackApi;
use Mandisma\SpotifyApiClient\Api\UserProfileApi;
use Mandisma\SpotifyApiClient\Client\AuthenticatedHttpClient;
use Mandisma\SpotifyApiClient\Security\AuthorizationInterface;

final class ClientBuilder
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    public function __construct(AuthorizationInterface $authorization)
    {
        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => Client::API_URL,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $this->authorization = $authorization;
    }

    /**
     * Change the default http client.
     *
     * @param HttpClientInterface $httpClient
     * @return self
     */
    public function withHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Build a client from an authorization object
     *
     * @return Client
     */
    public function build(): Client
    {
        $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $this->authorization);

        $client = new Client(
            new AlbumApi($authenticatedHttpClient),
            new ArtistApi($authenticatedHttpClient),
            new BrowseApi($authenticatedHttpClient),
            new EpisodeApi($authenticatedHttpClient),
            new FollowApi($authenticatedHttpClient),
            new LibraryApi($authenticatedHttpClient),
            new PersonalizationApi($authenticatedHttpClient),
            new PlayerApi($authenticatedHttpClient),
            new PlaylistApi($authenticatedHttpClient),
            new SearchApi($authenticatedHttpClient),
            new ShowApi($authenticatedHttpClient),
            new TrackApi($authenticatedHttpClient),
            new UserProfileApi($authenticatedHttpClient)
        );

        return $client;
    }
}
