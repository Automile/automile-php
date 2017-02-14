<?php

namespace Automile\Sdk\Models;

/**
 * VehicleFuelLevelInput Rowset Model
 * @package Automile\Sdk\Models
 */
class VehicleFuelLevelInputRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleFuelLevelInput
     */
    public function getModel($properties)
    {
        return new VehicleFuelLevelInput($properties);
    }
}
