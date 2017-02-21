<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\VehicleGeofence as VehicleGeofenceModel;
use Automile\Sdk\Models\VehicleGeofenceRowset;

/**
 * VehicleGeofence API Queries
 * @package Automile\Sdk\Endpoints
 */
trait VehicleGeofence
{

    private $_vehicleGeofenceUri = '/v1/resourceowner/vehiclegeofence';

    /**
     * Get details about a specific relationship between the geofence and the vehicle
     * @param int $vehicleGeofenceId
     * @return VehicleGeofenceModel
     */
    public function getVehicleGeofenceById($vehicleGeofenceId)
    {
        return $this->_getById($this->_vehicleGeofenceUri, $vehicleGeofenceId, new VehicleGeofenceModel());
    }

    /**
     * Get all relationships between geofences and vehicles
     * @param int $geofenceId
     * @return VehicleGeofenceRowset
     * @throws AutomileException
     */
    public function getVehicleGeofencesByGeofenceId($geofenceId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleGeofenceUri)
            ->setUriParam('geofenceId', $geofenceId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleGeofenceRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Creates a relationship between a vehicle and a geofence and returns the newly created relationship
     * @param VehicleGeofenceModel $model
     * @return VehicleGeofenceModel
     */
    public function createVehicleGeofence(VehicleGeofenceModel $model)
    {
        return $this->_create($this->_vehicleGeofenceUri, $model);
    }

    /**
     * Edit a relationship between a vehicle and a geofence
     * @param VehicleGeofenceModel $model
     * @return VehicleGeofenceModel
     * @throws AutomileException
     */
    public function editVehicleGeofence(VehicleGeofenceModel $model)
    {
        if (!$model->getVehicleGeofenceId()) {
            throw new AutomileException("VehicleGeofence ID is missing");
        }

        return $this->_edit($this->_vehicleGeofenceUri, $model->getVehicleGeofenceId(), $model);
    }

    /**
     * Removes association between a vehicle and geofence
     * @param int $vehicleGeofenceId
     * @return bool
     */
    public function deleteVehicleGeofence($vehicleGeofenceId)
    {
        return $this->_delete($this->_vehicleGeofenceUri, $vehicleGeofenceId);
    }

}
