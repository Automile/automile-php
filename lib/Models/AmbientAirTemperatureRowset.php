<?php

namespace Automile\Sdk\Models;

/**
 * AmbientAirTemperature Rowset Model
 */
class AmbientAirTemperatureRowset extends ModelRowsetAbstract
{


    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return AmbientAirTemperature
     */
    public function getModel($properties)
    {
        return new AmbientAirTemperature($properties);
    }
}
