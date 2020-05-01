# SpotifyApiClient

PHP Wrapper for the Spotify Api.

The library follow the structure from the Spotify Web Api Reference : https://developer.spotify.com/documentation/web-api/reference/

## Get the library

```bash
composer require mandisma/spotify-api-client
```

## How to use

**Initialize the client :**

```php
$clientBuilder = new \Mandisma\SpotifyApiClient\ClientBuilder();
// Refreshable app authorization. Tokens are automaticaly get before the request. Only works for non user request.
$client = $clientBuilder->buildByCredentials('your_client_id', 'your_client_secret', 'your_redirect_uri');
// or Refreshable user authorization
$client = $clientBuilder->buildByTokens('your_client_id', 'your_client_secret', 'your_redirect_uri', 'access_token', 'refresh_token');
```

**Request an authorization code :**

```php
$clientBuilder = new \Mandisma\SpotifyApiClient\ClientBuilder();
$client = $clientBuilder->buildByCredentials('your_client_id', 'your_client_secret', 'your_redirect_uri');
$scopes = ['user-read-playback-state'];
// It will redirect to the spotify authorization url and after validation to your redirect url
$client->getAuthenticationApi()->requestAuthorizationCode($scopes);
```

**Request an access token from an authorization code :**

```php
$clientBuilder = new \Mandisma\SpotifyApiClient\ClientBuilder();
$client = $clientBuilder->buildByCredentials('your_client_id', 'your_client_secret', 'your_redirect_uri');
$authentication = $client->getAuthenticationApi()->requestAccessToken('the_authorization_code');
```

After the operation below access_token and refresh_token will automatically set to the client for the current execution.
I recommended you to save the tokens for the next initialization. You can get tokens like this :

```php
$authentication->getAccessToken();
$authentication->getRefreshToken();
```

**And enjoy :**

```php
$playedTracks = $client->getPlayerApi()->getRecentlyPlayedTracks();
```

## Test

Run PHPUnit : `./vendor/bin/phpunit`
