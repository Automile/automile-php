<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleBatteryEvent Rowset Model
 */
class BatteryEventRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return BatteryEvent
     */
    public function getModel($properties)
    {
        return new BatteryEvent($properties);
    }

}
