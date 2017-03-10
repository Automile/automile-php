<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * TravelTime Report Rowset Model
 */
class TravelTimeRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TravelTime
     */
    public function getModel($properties)
    {
        return new TravelTime($properties);
    }

}
