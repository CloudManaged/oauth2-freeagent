# FreeAgent provider for league/oauth2-client

This is a package to integrate FreeAgent authentication with the OAuth2 client library by
[The League of Extraordinary Packages](https://github.com/thephpleague/oauth2-client).

To install, use composer:

```bash
composer require contactzilla/oauth2-freeagent
```

Usage is the same as the league's OAuth client, using `\Contactzilla\OAuth2\Client\Provider\FreeAgent` as the provider.
For example:

```php
$provider = new \Contactzilla\OAuth2\Client\Provider\FreeAgent([
    'clientId' => "YOUR_CLIENT_ID",
    'clientSecret' => "YOUR_CLIENT_SECRET",
    'redirectUri' => "http://your-redirect-uri"
]);


if (isset($_GET['code']) && $_GET['code']) {
    $token = $this->provider->getAccessToken("authorizaton_code", [
        'code' => $_GET['code']
    ]);

    // Returns an instance of Contactzilla\OAuth2\Client\Provider\Company
    $company = $this->provider->getUserDetails($token);

    // $company->name = [ Company name ]
    // $company->type = [ Company type ]
    // $company->company_registration_number = [ Company Registration Number ]
}
```