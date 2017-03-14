<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleFuelLevelInput Rowset Model
 */
class FuelLevelInputRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return FuelLevelInput
     */
    public function getModel($properties)
    {
        return new FuelLevelInput($properties);
    }
}
