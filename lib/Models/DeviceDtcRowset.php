<?php

namespace Automile\Sdk\Models;

/**
 * DeviceDtc Rowset Model
 */
class DeviceDtcRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DeviceDtc
     */
    public function getModel($properties)
    {
        return new DeviceDtc($properties);
    }

}
