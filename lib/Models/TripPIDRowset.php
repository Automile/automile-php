<?php

namespace Automile\Sdk\Models;

/**
 * TripPID Rowset Model
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
