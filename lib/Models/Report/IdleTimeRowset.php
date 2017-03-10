<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * IdleTime Report Rowset Model
 */
class IdleTimeRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return IdleTime
     */
    public function getModel($properties)
    {
        return new IdleTime($properties);
    }

}
