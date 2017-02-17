<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\CompanyContact;
use Automile\Sdk\Models\CompanyContactRowset;

/**
 * FleetContact API Queries
 * @package Automile\Sdk\Endpoints
 */
trait FleetContact
{

    private $_fleetContactUri = '/v1/resourceowner/companycontact';

    /**
     * Get the company contact relationship
     * @param int $fleetContactId
     * @return CompanyContact
     */
    public function getFleetContactById($fleetContactId)
    {
        return $this->_getById($this->_fleetContactUri, $fleetContactId, new CompanyContact());
    }

    /**
     * Get a list of all company contacts that user is associated with
     * @return CompanyContactRowset
     */
    public function getFleetContacts()
    {
        return $this->_getAll($this->_fleetContactUri, new CompanyContactRowset());
    }

    /**
     * Get all relationships between a specific fleet and it's contacts
     * @param int $fleetId
     * @return CompanyContactRowset
     * @throws AutomileException
     */
    public function getFleetContactsByFleetId($fleetId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_fleetContactUri)
            ->setUriParam('companyId', $fleetId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new CompanyContactRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Creates a new company contact and associates it with user
     * @param CompanyContact $contact
     * @return CompanyContact
     */
    public function createFleetContact(CompanyContact $contact)
    {
        return $this->_create($this->_fleetContactUri, $contact);
    }

    /**
     * Updates the given companycontact id
     * @param CompanyContact $contact
     * @return CompanyContact
     * @throws AutomileException
     */
    public function editFleetContact(CompanyContact $contact)
    {
        if (!$contact->getCompanyContactId()) {
            throw new AutomileException('Fleet Contact ID is missing');
        }

        return $this->_edit($this->_fleetContactUri, $contact->getCompanyContactId(), $contact);
    }

    /**
     * Removes the given company contact
     * @param int $id
     * @return mixed
     */
    public function deleteFleetContact($id)
    {
        return $this->_delete($this->_fleetContactUri, $id);
    }

}
