<?php

namespace Automile\Sdk\Models;

/**
 * TripPID Rowset Model
 * @package Automile\Sdk\Models
 */
class TripPIDRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TripPID
     */
    public function getModel($properties)
    {
        return new TripPID($properties);
    }
}
