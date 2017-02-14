<?php

namespace Automile\Sdk\Models;

/**
 * VehicleSpeed Rowset Model
 * @package Automile\Sdk\Models
 */
class VehicleSpeedRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleSpeed
     */
    public function getModel($properties)
    {
        return new VehicleSpeed($properties);
    }

}
