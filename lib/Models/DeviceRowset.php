<?php

namespace Automile\Sdk\Models;

/**
 * Device Rowset Model
 */
class DeviceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Device
     */
    public function getModel($properties)
    {
        return new Device($properties);
    }

}
