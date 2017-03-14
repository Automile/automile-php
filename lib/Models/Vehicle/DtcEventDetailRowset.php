<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * VehicleDtcEventDetail Rowset Model
 */
class DtcEventDetailRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DtcEventDetail
     */
    public function getModel($properties)
    {
        return new DtcEventDetail($properties);
    }

}
