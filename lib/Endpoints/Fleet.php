<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Models\Company;
use Automile\Sdk\Models\CompanyRowset;

/**
 * Fleet API Queries
 * @package Automile\Sdk\Endpoints
 */
trait Fleet
{

    private $_fleetUri = '/v1/resourceowner/companies';

    /**
     * Get a list of all companies that user is associated with
     * @return CompanyRowset
     */
    public function getFleets()
    {
        return $this->_getAll($this->_fleetUri, new CompanyRowset());
    }

    /**
     * Get a company by id
     * @param int $id
     * @return Company
     */
    public function getFleetById($id)
    {
        return $this->_getById($this->_fleetUri, $id, new Company());
    }

    /**
     * Creates a new company and associates it with the user
     * @param Company $company
     * @return Company
     */
    public function createFleet(Company $company)
    {
        return $this->_create($this->_fleetUri, $company);
    }

    /**
     * Updates the given company id
     * @param Company $company
     * @return Company
     * @throws AutomileException
     */
    public function editFleet(Company $company)
    {
        if (!$company->getCompanyId()) {
            throw new AutomileException('Company ID is empty');
        }

        return $this->_edit($this->_fleetUri, $company->getCompanyId(), $company);
    }

    /**
     * Removes the given company
     * @param int $id
     * @return bool
     */
    public function deleteFleet($id)
    {
        return $this->_delete($this->_fleetUri, $id);
    }

}
