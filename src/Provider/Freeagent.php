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

    private $baseURL = 'https://api.freeagent.com/v2/';

    public function __construct(array $options = array())
    {
        parent::__construct($options);
        if (isset($options['sandbox']) && $options['sandbox']) {
            $this->baseURL = 'https://api.sandbox.freeagent.com/v2/';
        }
    }

    public function urlAuthorize()
    {
        return $this->baseURL.'approve_app';
    }

    public function urlAccessToken()
    {
        return $this->baseURL.'token_endpoint';
    }

    public function urlUserDetails(AccessToken $token = null)
    {
        return $this->baseURL.'company';
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

    /**
     * Create contact
     *
     * @param array $params
     * @return Contact
     *
     * @author Israel Sotomayor <israel@contactzilla.com>
     */
    public function createContact($params)
    {
        $url = $this->urlContacts();

        $data = ['contact' => $params];
        return $response = $this->saveProviderData($url, $data);

        //return $this->contactDetails(json_decode($response));
        return $params;
    }

    protected function urlContacts()
    {
        return $this->baseURL.'contacts';
    }

    protected function contactDetails($response)
    {
        $response = (array)($response->contact);
        $user = new Contact($response);

        return $user;
    }

    /**
     * (POST)
     *
     * @param $url
     * @param array $data
     * @return \Guzzle\Http\EntityBodyInterface|string
     * @throws IDPException
     *
     * @author Israel Sotomayor <israel@contactzilla.com>
     */
    protected function saveProviderData($url, $data)
    {
        try {
            $client = $this->getHttpClient();
            //$client->setBaseUrl($url);

            if ($this->headers) {
                $client->setDefaultOption('headers', $this->headers);
            }

            $request = $client->post($url, ['content-type' => 'application/json']);
            $request->setBody(json_encode($data));
            $response = $request->send();
        } catch (BadResponseException $e) {
            // @codeCoverageIgnoreStart
            $raw_response = explode("\n", $e->getResponse());
            throw new IDPException(end($raw_response));
            // @codeCoverageIgnoreEnd
        }

        return $response;
    }
}
