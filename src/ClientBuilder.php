<?php

declare(strict_types=1);

namespace Mandisma\SpotifyApiClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Mandisma\SpotifyApiClient\Api\AlbumApi;
use Mandisma\SpotifyApiClient\Api\ArtistApi;
use Mandisma\SpotifyApiClient\Api\AuthenticationApi;
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
use Mandisma\SpotifyApiClient\Client\AuthenticationHttpClient;
use Mandisma\SpotifyApiClient\Security\AuthenticationInterface;

final class ClientBuilder
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    public function __construct(AuthenticationInterface $authentication)
    {
        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => Client::API_URL,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $this->authentication = $authentication;
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
     * Build a client from an authentication object
     *
     * @return Client
     */
    public function build(): Client
    {
        $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $this->authentication);
        $authenticationHttpClient = new AuthenticationHttpClient($this->httpClient, $this->authentication);

        $client = new Client(
            new AlbumApi($authenticatedHttpClient),
            new ArtistApi($authenticatedHttpClient),
            new AuthenticationApi($authenticationHttpClient, $this->authentication),
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
