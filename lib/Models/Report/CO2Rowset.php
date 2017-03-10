<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * CO2 Report Rowset Model
 */
class CO2Rowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return CO2
     */
    public function getModel($properties)
    {
        return new CO2($properties);
    }

}
