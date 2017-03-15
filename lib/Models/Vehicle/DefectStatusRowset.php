<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle DefectStatus Rowset Model
 */
class DefectStatusRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DefectStatus
     */
    public function getModel($properties)
    {
        return new DefectStatus($properties);
    }

}
