<?php

namespace Automile\Sdk\Models;

/**
 * AmbientAirTemperature Rowset Model
 * @package Automile\Sdk\Models
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
