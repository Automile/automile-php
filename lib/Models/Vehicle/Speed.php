<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleSpeed Model
 * 
 * @method float getSpeedKmPerHour()
 * @method string getRecordTimeStamp()
 *
 * @method Speed setSpeedKmPerHour(float $speed)
 * @method Speed setRecordTimeStamp(string $timeStamp)
 */
class Speed extends ModelAbstract
{

    protected $_allowedProperties = [
        "SpeedKmPerHour",
        "RecordTimeStamp"
    ];

}
