<?php

namespace Automile\Sdk\Endpoints;


use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\AmbientAirTemperatureRowset;
use Automile\Sdk\Models\TripGeoRowset;
use Automile\Sdk\Models\TripPIDRowset;
use Automile\Sdk\Models\TripRowset;
use Automile\Sdk\Models\Trip as TripModel;
use Automile\Sdk\Models\TripStartEndGeo;
use Automile\Sdk\Models\VehicleEngineCoolantTemperatureRowset;
use Automile\Sdk\Models\VehicleFuelLevelInputRowset;
use Automile\Sdk\Models\VehicleRPMRowset;
use Automile\Sdk\Models\VehicleSpeedRowset;

/**
 * Trip API methods
 * @package Automile\Sdk\Endpoints
 */
trait Trip
{

    private $_tripUri = '/v1/resourceowner/trips';

    /**
     * Get all trips that the user has access to
     * @param $lastNumberOfDays
     * @param int $vehicleId
     * @param bool $synchronized
     * @return TripRowset
     * @throws AutomileException
     */
    public function getTrips($lastNumberOfDays, $vehicleId = null, $synchronized = true)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri)
            ->setUriParam('lastNumberOfDays', (int)$lastNumberOfDays)
            ->setUriParam('vehicleId', (int)$vehicleId ?: null)
            ->setUriParam('synchronized', $synchronized ? 'true' : 'false');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the details about the trip
     * @param int $tripId
     * @return TripModel
     * @throws AutomileException
     */
    public function getTripById($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripModel($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the trip start and stop geo locations
     * @param int $tripId
     * @return TripStartEndGeo
     * @throws AutomileException
     */
    public function getTripStartStopLatitudeLongitude($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/geostartend');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripStartEndGeo($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the vehicle speed if it's reported by the vehicle
     * @param int $tripId
     * @return VehicleSpeedRowset
     * @throws AutomileException
     */
    public function getTripSpeed($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/speed');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleSpeedRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the vehicle engine rpm if it's reported by the vehicle
     * @param int $tripId
     * @return VehicleRPMRowset
     * @throws AutomileException
     */
    public function getTripRPM($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/rpm');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleRPMRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the vehicle ambient (outside) temperature if it's reported by the vehicle
     * @param int $tripId
     * @return AmbientAirTemperatureRowset
     * @throws AutomileException
     */
    public function getTripAmbientTemperature($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/ambienttemperature');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new AmbientAirTemperatureRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the vehicle current fuel level if it's reported by the vehicle
     * @param int $tripId
     * @return VehicleFuelLevelInputRowset
     * @throws AutomileException
     */
    public function getTripFuelLevel($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/fuellevelinput');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleFuelLevelInputRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the engine coolant temperature if it's reported by the vehicle
     * @param $tripId
     * @return VehicleEngineCoolantTemperatureRowset
     * @throws AutomileException
     */
    public function getTripEngineCoolantTemperature($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/enginecoolanttemperature');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleEngineCoolantTemperatureRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * This will get the raw PID data if the vehicle has reported that it is being recorded
     * @param int $tripId
     * @param int $pidId
     * @return TripPIDRowset
     * @throws AutomileException
     */
    public function getTripPIDRaw($tripId, $pidId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/pid/' . (int)$pidId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripPIDRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the latitude and longitude records in the trip, supports both ongoing and completed trips
     * @param int $tripId
     * @param int $everyNthRecord
     * @param bool $snapToRoad
     * @return TripGeoRowset
     * @throws AutomileException
     */
    public function geoTripLatitudeLongitude($tripId, $everyNthRecord = 1, $snapToRoad = true)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/geo')
            ->setUriParam('everyNthRecord', (int)$everyNthRecord ?: null)
            ->setUriParam('snapToRoad', $snapToRoad ? 'true' : 'false');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripGeoRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
