<?php

namespace Automile\Sdk\Models;

/**
 * Geofence Rowset Model
 */
class GeofenceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Geofence
     */
    public function getModel($properties)
    {
        return new Geofence($properties);
    }

}
