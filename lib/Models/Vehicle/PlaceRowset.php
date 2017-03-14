<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehiclePlace Rowset Model
 */
class PlaceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Place
     */
    public function getModel($properties)
    {
        return new Place($properties);
    }

}
