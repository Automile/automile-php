<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Fuel Report Rowset Model
 */
class FuelRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Fuel
     */
    public function getModel($properties)
    {
        return new Fuel($properties);
    }

}
