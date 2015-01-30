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