# FreeAgent provider for league/oauth2-client

This is a package to integrate FreeAgent authentication with the OAuth2 client library by
[The League of Extraordinary Packages](https://github.com/thephpleague/oauth2-client).

To install, use composer:

```bash
composer require cloudmanaged/oauth2-freeagent
```

Usage is the same as the league's OAuth client, using `\CloudManaged\OAuth2\Client\Provider\FreeAgent` as the provider.
For example:

```php
$provider = new \CloudManaged\OAuth2\Client\Provider\FreeAgent([
    'sandbox' => "TRUE_OR_FALSE",
    'clientId' => "YOUR_CLIENT_ID",
    'clientSecret' => "YOUR_CLIENT_SECRET",
    'responseType' => "JSON_OR_STRING"
    'redirectUri' => "http://your-redirect-uri"
]);

$token = $provider->getAccessToken('refresh_token', [
    'grant_type' => 'refresh_token',
    'refresh_token' => "REFRESH_TOKEN"
]);

// OR (to get the token)

$token = $this->provider->getAccessToken("authorizaton_code", [
    'code' => $_GET['code']
]);

// pass the token to the headers
$provider->headers = ['Authorization' => 'Bearer ' . $token];

// returns an instance of CloudManaged\OAuth2\Client\Provider\Company
$company = $this->provider->getUserDetails($token);

// $company->name = [ Company name ]
// $company->type = [ Company type ]
// $company->company_registration_number = [ Company Registration Number ]

```

## License

This provider is under the MIT license. See the complete license in the provider:

[LICENSE](https://github.com/CloudManaged/oauth2-freeagent/LICENSE)

## About

oAuth2FreeAgent is a [CloudManaged](https://github.com/CloudManaged) initiative.
See also the list of [contributors](https://github.com/CloudManaged/oauth2-freeagent/graphs/contributors).

## Reporting an issue or a feature request

Issues and feature requests are tracked in the [GitHub issue tracker](https://github.com/CloudManaged/oauth2-freeagent/issues).

## Note

If you need a full wrapper for FreeAgent API we have built this [freeagent-php](https://github.com/CloudManaged/freeagent-php) library with the idea to have access to all the API resources.