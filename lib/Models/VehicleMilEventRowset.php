<?php

namespace Automile\Sdk\Models;

/**
 * VehicleMilEvent Rowset Model
 */
class VehicleMilEventRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleMilEvent
     */
    public function getModel($properties)
    {
        return new VehicleMilEvent($properties);
    }

}
