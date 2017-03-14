<?php

namespace Automile\Sdk\Endpoints;


use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\AmbientAirTemperatureRowset;
use Automile\Sdk\Models\TripConcatenation;
use Automile\Sdk\Models\TripGeoRowset;
use Automile\Sdk\Models\TripNote;
use Automile\Sdk\Models\TripPIDRowset;
use Automile\Sdk\Models\TripRowset;
use Automile\Sdk\Models\Trip as TripModel;
use Automile\Sdk\Models\TripStartEndGeo;
use Automile\Sdk\Models\TripSynchronized;
use Automile\Sdk\Models\Vehicle\EngineCoolantTemperatureRowset;
use Automile\Sdk\Models\Vehicle\FuelLevelInputRowset;
use Automile\Sdk\Models\Vehicle\RPMRowset;
use Automile\Sdk\Models\Vehicle\SpeedRowset;

/**
 * Trip API methods
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
     */
    public function getTripById($tripId)
    {
        return $this->_getById($this->_tripUri, $tripId, new TripModel());
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
     * @return SpeedRowset
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
            return new SpeedRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the vehicle engine rpm if it's reported by the vehicle
     * @param int $tripId
     * @return RPMRowset
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
            return new RPMRowset($response->getBody());
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
     * @return FuelLevelInputRowset
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
            return new FuelLevelInputRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the engine coolant temperature if it's reported by the vehicle
     * @param $tripId
     * @return EngineCoolantTemperatureRowset
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
            return new EngineCoolantTemperatureRowset($response->getBody());
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

    /**
     * Updates the given trip with a trip type (category) and trip tags
     * @param TripModel $trip
     * @return TripModel
     * @throws AutomileException
     */
    public function editTrip(TripModel $trip)
    {
        if (!$trip->getTripId()) {
            throw new AutomileException('Trip ID is empty');
        }

        return $this->_edit($this->_tripUri, $trip->getTripId(), $trip);
    }

    /**
     * Updates the last trip with trip notes
     * @param TripNote $note
     * @return TripNote
     * @throws AutomileException
     */
    public function addNoteToLastTrip(TripNote $note)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_tripUri . '/addnotestolasttrip')
            ->setBody($note->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $note;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Updates the given trip with given contactid
     * @param int $tripId
     * @param int $contactId
     * @return bool
     * @throws AutomileException
     */
    public function setDriverOnTrip($tripId, $contactId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_tripUri . '/setdriverontrip')
            ->setUriParam('tripId', (int)$tripId)
            ->setUriParam('contactId', (int)$contactId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Mark trips as synchronized, synchronized trips will not be returned when fetching trips
     * @param TripSynchronized $model
     * @return bool
     * @throws AutomileException
     */
    public function setSynchronized(TripSynchronized $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_tripUri . '/synchronized')
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Get the details about the trip including driving events, speeding and idling
     * @param int $tripId
     * @return TripConcatenation
     * @throws AutomileException
     */
    public function getCompletedTripDetails($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/details');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripConcatenation($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get the advanced details about the trip including driving events, speeding, idling, speed and rpm data series
     * @param int $tripId
     * @return TripConcatenation
     * @throws AutomileException
     */
    public function getCompletedTripDetailsAdvanced($tripId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_tripUri . '/' . (int)$tripId . '/advanced');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TripConcatenation($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
