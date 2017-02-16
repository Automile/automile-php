<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\GeofenceRowset;
use Automile\Sdk\Models\Geofence as GeofenceModel;

/**
 * Geofence API Queries
 * @package Automile\Sdk\Endpoints
 */
trait Geofence
{

    private $_geofenceUri = '/v1/resourceowner/geofence';

    /**
     * Get a list of geofencese user is associated with
     * @return GeofenceRowset
     */
    public function getGeofences()
    {
        return $this->_getAll($this->_geofenceUri, new GeofenceRowset());
    }

    public function getGeofenceById($geofenceId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_geofenceUri . '/' . (int)$geofenceId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new GeofenceModel($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get a list of geofencese user is associated with
     * @param GeofenceModel $geofence
     * @return GeofenceModel
     * @throws AutomileException
     */
    public function createGeofence(GeofenceModel $geofence)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_geofenceUri)
            ->setBody($geofence->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            $geofence->reset($response->getBody());
            return $geofence;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Updates the given geofence with new model
     * @param GeofenceModel $geofence
     * @return GeofenceModel
     * @throws AutomileException
     */
    public function editGeofence(GeofenceModel $geofence)
    {
        if (!$geofence->getGeofenceId()) {
            throw new AutomileException('Geofence ID is empty');
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_geofenceUri . '/' . (int)$geofence->getGeofenceId())
            ->setBody($geofence->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $geofence;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Removes the given geofence
     * @param int $geofenceId
     * @return bool
     */
    public function deleteGeofence($geofenceId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_DELETE)
            ->setUri($this->_geofenceUri . '/' . (int)$geofenceId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
