<?php

namespace Automile\Sdk\Models;

/**
 * Vehicle2Status Rowset
 * @package Automile\Sdk\Models
 */
class Vehicle2StatusRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return ModelAbstract
     */
    public function getModel($properties)
    {
        return new Vehicle2Status($properties);
    }

}
