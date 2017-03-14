<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleFuelLevelInput Model
 *
 * @method float getFuelLevelInPercentage()
 * @method string getRecordTimeStamp()
 *
 * @method FuelLevelInput setFuelLevelInPercentage(float $fuelLevel)
 * @method FuelLevelInput setRecordTimeStamp(string $timeStamp)
 */
class FuelLevelInput extends ModelAbstract
{

    protected $_allowedProperties = [
        "FuelLevelInPercentage",
        "RecordTimeStamp"
    ];

}
