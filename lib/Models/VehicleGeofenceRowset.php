<?php

namespace Automile\Sdk\Models;

/**
 * VehicleGeofence Rowset Model
 * @package Automile\Sdk\Models
 */
class VehicleGeofenceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleGeofence
     */
    public function getModel($properties)
    {
        return new VehicleGeofence($properties);
    }

}
