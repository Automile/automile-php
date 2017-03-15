<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Vehicle\Inspection;
use Automile\Sdk\Models\Vehicle\InspectionExport;
use Automile\Sdk\Models\Vehicle\InspectionRowset;

/**
 * Inspection API Queries
 */
trait VehicleInspection
{

    protected $_vehicleInspectionUri = '/v1/resourceowner/vehicleinspection';

    /**
     * Get a vehicle inspection
     * @param int $id
     * @return Inspection
     */
    public function getByInspectionId($id)
    {
        return $this->_getById($this->_vehicleInspectionUri, $id, new Inspection());
    }

    /**
     * Get all vehicle inspections that the user has access to
     * @param int $vehicleInspectionId
     * @param int $vehicleId
     * @param \DateTime $fromDate
     * @param \DateTime $toDate
     * @param bool $excludeArchived
     * @return InspectionRowset
     * @throws AutomileException
     */
    public function getByInspectionIdVehicleAndDate($vehicleInspectionId = null, $vehicleId = null,
        \DateTime $fromDate = null, \DateTime $toDate = null, $excludeArchived = true)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleInspectionUri)
            ->setUriParam('vehicleInspectionid', $vehicleInspectionId)
            ->setUriParam('vehicleId', $vehicleId)
            ->setUriParam('fromDate', $fromDate ? $fromDate->format('Y-m-d') : null)
            ->setUriParam('toDate', $toDate ? $toDate->format('Y-m-d') : null)
            ->setUriParam('excludeArchived', $excludeArchived ? 'true' : 'false');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new InspectionRowset($response->getBody());
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Creates a new vehicle inspection
     * @param Inspection $inspection
     * @return Inspection
     */
    public function createInspection(Inspection $inspection)
    {
        return $this->_create($this->_vehicleInspectionUri, $inspection);
    }

    /**
     * Updates the given vehicle inspection with new model
     * @param Inspection $inspection
     * @return Inspection
     * @throws AutomileException
     */
    public function editInspection(Inspection $inspection)
    {
        if (!$inspection->getVehicleInspectionId())
        {
            throw new AutomileException('Vehicle Inspection ID is missing');
        }

        return $this->_edit($this->_vehicleInspectionUri, $inspection->getVehicleInspectionId(), $inspection);
    }

    /**
     * Export a vehicle inspection in pdf format via email
     * @param int $vehicleInspectionId
     * @param InspectionExport $model
     * @return bool
     * @throws AutomileException
     */
    public function exportVehicleInspection($vehicleInspectionId, InspectionExport $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_vehicleInspectionUri . '/export/' . $vehicleInspectionId)
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }
}
