<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleSpeed Rowset Model
 */
class SpeedRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Speed
     */
    public function getModel($properties)
    {
        return new Speed($properties);
    }

}
