<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleEngineCoolantTemperature Rowset Model
 */
class EngineCoolantTemperatureRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return EngineCoolantTemperature
     */
    public function getModel($properties)
    {
        return new EngineCoolantTemperature($properties);
    }
}
