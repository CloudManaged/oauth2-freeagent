<?php

namespace Contactzilla\OAuth2\Client\Provider;

use Contactzilla\OAuth2\Client\Entity\Company;
use Guzzle\Http\Exception\BadResponseException;
use League\OAuth2\Client\Exception\IDPException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class FreeAgent extends AbstractProvider
{
    public $scopes = [];
    public $responseType = 'string';

    public function urlAuthorize()
    {
        return 'https://api.sandbox.freeagent.com/v2/approve_app';
    }

    public function urlAccessToken()
    {
        return 'https://api.sandbox.freeagent.com/v2/token_endpoint';
    }

    public function urlUserDetails(AccessToken $token = null)
    {
        return 'https://api.sandbox.freeagent.com/v2/company';
    }

    public function userDetails($response, AccessToken $token)
    {
        $response = (array)($response->company);
        $user = new Company($response);

        return $user;
    }

    protected function fetchUserDetails(AccessToken $token)
    {
        $url = $this->urlUserDetails();

        return $this->fetchProviderData($url, $token);
    }

    protected function fetchProviderData($url, AccessToken $token = null)
    {
        try {
            $client = $this->getHttpClient();
            $client->setBaseUrl($url);

            if (isset($token)) {
                $this->headers = ['Authorization' => 'Bearer ' . $token];
            }

            if ($this->headers) {
                $client->setDefaultOption('headers', $this->headers);
            }

            $request = $client->get()->send();
            $response = $request->getBody();
        } catch (BadResponseException $e) {
            // @codeCoverageIgnoreStart
            $raw_response = explode("\n", $e->getResponse());
            throw new IDPException(end($raw_response));
            // @codeCoverageIgnoreEnd
        }

        return $response;
    }
}
