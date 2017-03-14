<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Class InspectionRowset
 */
class InspectionRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Inspection
     */
    public function getModel($properties)
    {
        return new Inspection($properties);
    }

}
