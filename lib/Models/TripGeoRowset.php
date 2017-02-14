<?php

namespace Automile\Sdk\Models;

/**
 * TripGeo Rowset Model
 * @package Automile\Sdk\Models
 */
class TripGeoRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TripGeo
     */
    public function getModel($properties)
    {
        return new TripGeo($properties);
    }

}
