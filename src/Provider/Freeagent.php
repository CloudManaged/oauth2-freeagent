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

    protected function urlContacts()
    {
        return $this->baseURL . 'contacts';
    }

    public function userDetails($response, AccessToken $token)
    {
        $response = (array)($response->company);
        $company = new Company($response);

        return $company;
    }

    protected function contactDetails($response)
    {
        $response = (array)($response->contact);
        $contact = new Contact($response);

        return $contact;
    }

    /**
     * Create contact
     *
     * @param $params
     * @return \Guzzle\Http\EntityBodyInterface|string
     * @throws IDPException
     *
     * @author Israel Sotomayor <israel@contactzilla.com>
     */
    public function createContact($params)
    {
        $url = $this->urlContacts();

        $data = ['contact' => $params];
        return $this->saveProviderData($url, $data);
    }

    /**
     * Update contact
     *
     * @param $params
     * @param null $contactId
     * @return \Guzzle\Http\EntityBodyInterface|string
     * @throws IDPException
     *
     * @author Israel Sotomayor <israel@contactzilla.com>
     */
    public function updateContact($params, $contactId = null)
    {
        $url = $this->urlContacts() . '/' . $contactId;

        $data = ['contact' => $params];
        return $this->updateProviderData($url, $data);
    }

    protected function fetchUserDetails(AccessToken $token)
    {
        $url = $this->urlUserDetails();
        return $this->fetchProviderData($url, $token);
    }

    /**
     * (POST) Save data
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

    /**
     * (PUT) Update data
     *
     * @param $url
     * @param array $data
     * @return \Guzzle\Http\EntityBodyInterface|string
     * @throws IDPException
     *
     * @author Israel Sotomayor <israel@contactzilla.com>
     */
    protected function updateProviderData($url, $data)
    {
        try {
            $client = $this->getHttpClient();

            if ($this->headers) {
                $client->setDefaultOption('headers', $this->headers);
            }

            $request = $client->put($url, ['content-type' => 'application/json']);
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
