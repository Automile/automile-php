<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle Defect Rowset Model
 */
class DefectRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Defect
     */
    public function getModel($properties)
    {
        return new Defect($properties);
    }

}
