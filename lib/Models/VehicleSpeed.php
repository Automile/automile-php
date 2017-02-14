<?php

namespace Automile\Sdk\Models;

/**
 * VehicleSpeed Model
 * @package Automile\Sdk\Models
 * @method float getSpeedKmPerHour()
 * @method string getRecordTimeStamp()
 */
class VehicleSpeed extends ModelAbstract
{

    protected $_allowedProperties = [
        "SpeedKmPerHour",
        "RecordTimeStamp"
    ];

}
