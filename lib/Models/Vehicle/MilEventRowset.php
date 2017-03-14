<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleMilEvent Rowset Model
 */
class MilEventRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return MilEvent
     */
    public function getModel($properties)
    {
        return new MilEvent($properties);
    }

}
