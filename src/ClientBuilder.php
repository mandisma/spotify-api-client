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
use Mandisma\SpotifyApiClient\Client\ResourceClient;
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
        $authenticationApi = new AuthenticationApi($this->httpClient, $this->authentication);
        $authenticatedHttpClient = new AuthenticatedHttpClient($this->httpClient, $authenticationApi);

        $resourceClient = new ResourceClient($authenticatedHttpClient);

        $client = new Client(
            new AlbumApi($resourceClient),
            new ArtistApi($resourceClient),
            $authenticationApi,
            new BrowseApi($resourceClient),
            new EpisodeApi($resourceClient),
            new FollowApi($resourceClient),
            new LibraryApi($resourceClient),
            new PersonalizationApi($resourceClient),
            new PlayerApi($resourceClient),
            new PlaylistApi($resourceClient),
            new SearchApi($resourceClient),
            new ShowApi($resourceClient),
            new TrackApi($resourceClient),
            new UserProfileApi($resourceClient)
        );

        return $client;
    }
}
