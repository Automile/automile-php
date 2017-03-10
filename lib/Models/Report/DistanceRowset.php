<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Distance Report Rowset Model
 */
class DistanceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Distance
     */
    public function getModel($properties)
    {
        return new Distance($properties);
    }

}
