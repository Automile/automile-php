<?php

namespace Automile\Sdk\Models;

/**
 * Trip Rowset Model
 */
class TripRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Trip
     */
    public function getModel($properties)
    {
        return new Trip($properties);
    }

}