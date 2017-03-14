<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleRPM Model
 *
 * @method float getRPMValue()
 * @method string getRecordTimeStamp()
 *
 * @method RPM setRPMValue(float $rpm)
 * @method RPM setRecordTimeStamp(string $timeStamp)
 */
class RPM extends ModelAbstract
{

    protected $_allowedProperties = [
        "RPMValue",
        "RecordTimeStamp"
    ];

}
