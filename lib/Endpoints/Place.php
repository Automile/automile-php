<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\PlaceRowset;
use Automile\Sdk\Models\Place as PlaceModel;

/**
 * Place API Queries
 * @package Automile\Sdk\Endpoints
 */
trait Place
{

    protected $_placeUri = '/v1/resourceowner/place';

    /**
     * Get places
     * @return PlaceRowset
     */
    public function getPlaces()
    {
        return $this->_getAll($this->_placeUri, new PlaceRowset());
    }

    /**
     * Get place
     * @param int $placeId
     * @return PlaceModel
     * @throws AutomileException
     */
    public function getPlaceById($placeId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_placeUri . '/' . (int)$placeId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new PlaceModel($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Creates a new place
     * @param PlaceModel $place
     * @return PlaceModel
     * @throws AutomileException
     */
    public function createPlace(PlaceModel $place)
    {
        if (!$place->isValid()) {
            throw new AutomileException("Model is invalid");
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_placeUri)
            ->setBody($place->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            $place->reset($response->getBody());
            return $place;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Updates the given place with new model
     * @param PlaceModel $place
     * @return PlaceModel
     * @throws AutomileException
     */
    public function editPlace(PlaceModel $place)
    {
        if (!$place->getPlaceId()) {
            throw new AutomileException('Place ID is empty');
        }

        if (!$place->isValid()) {
            throw new AutomileException("Model is invalid");
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_placeUri . '/' . (int)$place->getPlaceId())
            ->setBody($place->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $place;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Removes the given company
     * @param $placeId
     * @return bool
     * @throws AutomileException
     */
    public function deletePlace($placeId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_DELETE)
            ->setUri($this->_placeUri . '/' . (int)$placeId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
