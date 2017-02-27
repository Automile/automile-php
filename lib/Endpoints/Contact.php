<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Contact as ContactModel;
use Automile\Sdk\Models\ContactRowset;

/**
 * Contacts API methods
 */
trait Contact
{

    private $_contactsUri = '/v1/resourceowner/contacts2';

    /**
     * Get a list of all contacts that user is associated with
     * @return ContactRowset
     */
    public function getContacts()
    {
        return $this->_getAll($this->_contactsUri, new ContactRowset());
    }

    /**
     * Get a contact by id
     * @param int $contactId
     * @return ContactModel
     */
    public function getContactById($contactId)
    {
        return $this->_getById($this->_contactsUri, $contactId, new ContactModel());
    }

    /**
     * Get the contact representing myself
     * @return ContactModel
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
            return new ContactModel($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
