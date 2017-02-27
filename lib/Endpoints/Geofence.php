<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Models\GeofenceRowset;
use Automile\Sdk\Models\Geofence as GeofenceModel;

/**
 * Geofence API Queries
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

    /**
     * Get geofence
     * @param int $geofenceId
     * @return GeofenceModel
     */
    public function getGeofenceById($geofenceId)
    {
        return $this->_getById($this->_geofenceUri, $geofenceId, new GeofenceModel());
    }

    /**
     * Creates a new geofence
     * @param GeofenceModel $geofence
     * @return GeofenceModel
     */
    public function createGeofence(GeofenceModel $geofence)
    {
        return $this->_create($this->_geofenceUri, $geofence);
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

        return $this->_edit($this->_geofenceUri, $geofence->getGeofenceId(), $geofence);
    }

    /**
     * Removes the given geofence
     * @param int $geofenceId
     * @return bool
     */
    public function deleteGeofence($geofenceId)
    {
        return $this->_delete($this->_geofenceUri, $geofenceId);
    }

}
