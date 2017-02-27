<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Models\PlaceRowset;
use Automile\Sdk\Models\Place as PlaceModel;

/**
 * Place API Queries
 */
trait Place
{

    private $_placeUri = '/v1/resourceowner/place';

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
     */
    public function getPlaceById($placeId)
    {
        return $this->_getById($this->_placeUri, $placeId, new PlaceModel());
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

        return $this->_create($this->_placeUri, $place);
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

        return $this->_edit($this->_placeUri, $place->getPlaceId(), $place);
    }

    /**
     * Removes the given company
     * @param $placeId
     * @return bool
     */
    public function deletePlace($placeId)
    {
        return $this->_delete($this->_placeUri, $placeId);
    }

}
