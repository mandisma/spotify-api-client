# SpotifyApiClient

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mandisma/spotify-api-client.svg?style=flat-square)](https://packagist.org/packages/mandisma/spotify-api-client)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mandisma/spotify-api-client/PHP%20Composer?label=tests)](https://github.com/mandisma/spotify-api-client/actions?query=workflow%3A"PHP+Composer"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/mandisma/spotify-api-client.svg?style=flat-square)](https://packagist.org/packages/mandisma/spotify-api-client)

PHP Wrapper for the Spotify Api.

The library follow the structure from the Spotify Web Api Reference : <https://developer.spotify.com/documentation/web-api/reference/#/>

## Installation

You can install the package via composer:

```bash
composer require mandisma/spotify-api-client
```

## Usage

The OAuth2 authentication is not provided by this library. You have to do it or your own or use an existing library.

Then you have to create a class which implements the `AuthorizationInterface` before you can start.
This interface is needed to initialize the client.

**Initialize the client :**

```php
$clientBuilder = new \Mandisma\SpotifyApiClient\ClientBuilder();

$client = $clientBuilder->build(/*AuthorizationInterface*/ $authorization);

$playedTracks = $client->playerApi->getRecentlyPlayedTracks();
```

## Testing

```bash
composer test
```

## Credits

- [mandisma](https://github.com/mandisma)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.