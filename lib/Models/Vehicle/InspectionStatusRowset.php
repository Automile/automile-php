<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle InspectionStatus Rowset Model
 */
class InspectionStatusRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return InspectionStatus
     */
    public function getModel($properties)
    {
        return new InspectionStatus($properties);
    }

}
