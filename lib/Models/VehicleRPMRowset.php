<?php

namespace Automile\Sdk\Models;


class VehicleRPMRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return VehicleRPM
     */
    public function getModel($properties)
    {
        return new VehicleRPM($properties);
    }

}
