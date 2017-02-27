<?php

namespace Automile\Sdk\Models;

/**
 * DeviceEvent Rowset Model
 */
class DeviceEventRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DeviceEvent
     */
    public function getModel($properties)
    {
        return new DeviceEvent($properties);
    }

}
