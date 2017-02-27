<?php

namespace Automile\Sdk\Models;

/**
 * VehicleEngineCoolantTemperature Rowset Model
 */
class VehicleEngineCoolantTemperatureRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleEngineCoolantTemperature
     */
    public function getModel($properties)
    {
        return new VehicleEngineCoolantTemperature($properties);
    }
}
