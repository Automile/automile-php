<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle2Status Rowset
 */
class StatusRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Status
     */
    public function getModel($properties)
    {
        return new Status($properties);
    }

}
