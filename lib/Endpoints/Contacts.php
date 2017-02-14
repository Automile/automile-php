<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Contact;
use Automile\Sdk\Models\ContactRowset;

/**
 * Contacts API methods
 * @package Automile\Sdk\Endpoints
 */
trait Contacts
{

    private $_contactsUri = '/v1/resourceowner/contacts2';

    /**
     * Get a list of all contacts that user is associated with
     * @return ContactRowset
     * @throws AutomileException
     */
    public function getContacts()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_contactsUri);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new ContactRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get a contact by id
     * @param int $contactId
     * @return ContactRowset
     * @throws AutomileException
     */
    public function getContactById($contactId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_contactsUri . '/' . (int)$contactId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Contact($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the contact representing myself
     * @return ContactRowset
     * @throws AutomileException
     */
    public function getMe()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_contactsUri . '/me');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Contact($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
