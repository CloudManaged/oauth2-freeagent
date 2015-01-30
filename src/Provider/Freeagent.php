<?php

namespace CloudManaged\OAuth2\Client\Provider;

use CloudManaged\OAuth2\Client\Entity\Company;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class FreeAgent extends AbstractProvider
{
    public $responseType = 'string';
    public $baseURL = 'https://api.freeagent.com/v2/';

    public function __construct(array $options = array())
    {
        parent::__construct($options);
        if (isset($options['sandbox']) && $options['sandbox']) {
            $this->baseURL = 'https://api.sandbox.freeagent.com/v2/';
        }
    }

    public function urlBase()
    {
        return $this->baseURL;
    }

    public function urlAuthorize()
    {
        return $this->baseURL . 'approve_app';
    }

    public function urlAccessToken()
    {
        return $this->baseURL . 'token_endpoint';
    }

    public function urlUserDetails(AccessToken $token = null)
    {
        return $this->baseURL . 'company';
    }

    public function userDetails($response, AccessToken $token)
    {
        $response = (array)($response->company);
        $company = new Company($response);

        return $company;
    }
}
