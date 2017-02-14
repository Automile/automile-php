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
     * @throws AutomileException
     */
    public function getVehicles()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleUri);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Vehicle2Rowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the details about the vehicle
     * @param int $id
     * @return Vehicle2
     * @throws AutomileException
     */
    public function getVehicleById($id)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleUri . '/' . (int)$id);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Vehicle2($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
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

        $errorMessage = $response->getErrorMessage() ?: $response->getBody(true);
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

        $errorMessage = $response->getErrorMessage() ?: $response->getBody(true);
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Creates a new vehicle
     * @param Vehicle2 $vehicle
     * @return Vehicle2
     * @throws AutomileException
     */
    public function createVehicle(Vehicle2 $vehicle)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_vehicleUri)
            ->setBody($vehicle->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            $vehicle->reset($response->getBody());
            return $vehicle;
        }

        $errorMessage = $response->getErrorMessage() ?: $response->getBody(true);
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Removes the given vehicle
     * @param int $id
     * @return bool
     */
    public function deleteVehicle($id)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_DELETE)
            ->setUri($this->_vehicleUri . '/' . (int)$id);

        $isSuccessful = $client->send($request, $response);

        return $isSuccessful;
    }

    /**
     * Returns the external information we have on the vehicle
     * @param Vehicle2 $vehicle
     * @return Vehicle2
     * @throws AutomileException
     */
    public function editVehicle(Vehicle2 $vehicle)
    {
        if (!$vehicle->getVehicleId()) {
            throw new AutomileException('Vehicle ID is empty');
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_vehicleUri . '/' . (int)$vehicle->getVehicleId())
            ->setBody($vehicle->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $vehicle;
        }

        $errorMessage = $response->getErrorMessage() ?: $response->getBody(true);
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
