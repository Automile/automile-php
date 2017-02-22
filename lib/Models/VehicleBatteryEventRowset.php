<?php

namespace Automile\Sdk\Models;

/**
 * VehicleBatteryEvent Rowset Model
 * @package Automile\Sdk\Models
 */
class VehicleBatteryEventRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleBatteryEvent
     */
    public function getModel($properties)
    {
        return new VehicleBatteryEvent($properties);
    }

}
