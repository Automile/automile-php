<?php

namespace Automile\Sdk\Models;

/**
 * VehicleDtcEventDetail Rowset Model
 */
class VehicleDtcEventDetailRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleDtcEventDetail
     */
    public function getModel($properties)
    {
        return new VehicleDtcEventDetail($properties);
    }

}
