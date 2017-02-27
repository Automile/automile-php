<?php

namespace Automile\Sdk\Models;

/**
 * Model Rowset to operate with Vehicle models
 */
class Vehicle2Rowset extends ModelRowsetAbstract
{


    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Vehicle2
     */
    public function getModel($properties)
    {
        return new Vehicle2($properties);
    }

}