<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\VehiclePlace as VehiclePlaceModel;
use Automile\Sdk\Models\VehiclePlaceRowset;

/**
 * VehiclePlace API Queries
 */
trait VehiclePlace
{

    private $_vehiclePlaceUri = '/v1/resourceowner/vehicleplace';

    /**
     * Get details about a specific relationship between a place and a vehicle
     * @param int $vehiclePlaceId
     * @return VehiclePlaceModel
     */
    public function getVehiclePlaceById($vehiclePlaceId)
    {
        return $this->_getById($this->_vehiclePlaceUri, $vehiclePlaceId, new VehiclePlaceModel());
    }

    /**
     * Get all relationships between places and vehicles
     * @param int $placeId
     * @return VehiclePlaceRowset
     * @throws AutomileException
     */
    public function getVehiclePlacesByPlaceId($placeId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehiclePlaceUri)
            ->setUriParam('placeId', $placeId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehiclePlaceRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Creates a relationship between a vehicle and a place and returns the newly created relationship
     * @param VehiclePlaceModel $vehiclePlace
     * @return VehiclePlaceModel
     */
    public function createVehiclePlace(VehiclePlaceModel $vehiclePlace)
    {
        return $this->_create($this->_vehiclePlaceUri, $vehiclePlace);
    }

    /**
     * Edit the relationship between the vehicle and the place
     * @param VehiclePlaceModel $vehiclePlace
     * @return VehiclePlaceModel
     * @throws AutomileException
     */
    public function editVehiclePlace(VehiclePlaceModel $vehiclePlace)
    {
        if (!$vehiclePlace->getVehiclePlaceId()) {
            throw new AutomileException("VehiclePlace ID is missing");
        }

        return $this->_edit($this->_vehiclePlaceUri, $vehiclePlace->getVehiclePlaceId(), $vehiclePlace);
    }

    /**
     * Removes association between a vehicle and place
     * @param int $vehiclePlaceId
     * @return bool
     */
    public function deleteVehiclePlace($vehiclePlaceId)
    {
        return $this->_delete($this->_vehiclePlaceUri, $vehiclePlaceId);
    }

}
