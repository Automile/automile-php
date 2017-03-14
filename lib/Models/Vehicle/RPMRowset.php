<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Class VehicleRPMRowset
 */
class RPMRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return RPM
     */
    public function getModel($properties)
    {
        return new RPM($properties);
    }

}
