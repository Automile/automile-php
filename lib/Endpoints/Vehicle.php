<?php

namespace Automile\Sdk\Endpoints;


use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Vehicle2;
use Automile\Sdk\Models\Vehicle2Rowset;
use Automile\Sdk\Models\Vehicle2StatusRowset;
use Automile\Sdk\Models\VehicleCheckIn;

/**
 * Vehicle API methods
 * @package Automile\Sdk\Endpoints
 */
trait Vehicle
{

    private $_vehicleUri = 'v1/resourceowner/vehicles2';

    /**
     * Get all vehicles that the user has access to
     * @return Vehicle2Rowset
     */
    public function getVehicles()
    {
        return $this->_getAll($this->_vehicleUri, new Vehicle2Rowset());
    }

    /**
     * Get the details about the vehicle
     * @param int $id
     * @return Vehicle2
     */
    public function getVehicleById($id)
    {
        return $this->_getById($this->_vehicleUri, $id, new Vehicle2());
    }

    /**
     * Get position and status of all vehicles that the user has access to
     * @return Vehicle2StatusRowset
     * @throws AutomileException
     */
    public function getStatusForVehicles()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleUri . '/status');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Vehicle2StatusRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Check-in to a vehicle
     * @param VehicleCheckIn $checkIn
     * @return bool
     * @throws AutomileException
     */
    public function checkInToVehicle(VehicleCheckIn $checkIn)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_vehicleUri . '/checkin')
            ->setBody($checkIn->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Check-out from a vehicle
     * @return bool
     * @throws AutomileException
     */
    public function checkOut()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_vehicleUri . '/checkout');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Creates a new vehicle
     * @param Vehicle2 $vehicle
     * @return Vehicle2
     */
    public function createVehicle(Vehicle2 $vehicle)
    {
        return $this->_create($this->_vehicleUri, $vehicle);
    }

    /**
     * Removes the given vehicle
     * @param int $id
     * @return bool
     */
    public function deleteVehicle($id)
    {
        return $this->_delete($this->_vehicleUri, $id);
    }

    /**
     * Updates the given vehicle with new model
     * @param Vehicle2 $vehicle
     * @return Vehicle2
     */
    public function editVehicle(Vehicle2 $vehicle)
    {
        if (!$vehicle->getVehicleId()) {
            throw new AutomileException('Vehicle ID is empty');
        }

        return $this->_edit($this->_vehicleUri, $vehicle->getVehicleId(), $vehicle);
    }

}
