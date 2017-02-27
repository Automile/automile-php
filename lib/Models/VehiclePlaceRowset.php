<?php

namespace Automile\Sdk\Models;

/**
 * VehiclePlace Rowset Model
 */
class VehiclePlaceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehiclePlace
     */
    public function getModel($properties)
    {
        return new VehiclePlace($properties);
    }

}
