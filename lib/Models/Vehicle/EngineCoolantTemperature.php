<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleEngineCoolantTemperature Model
 *
 * @method float getTemperatureInCelsius()
 * @method string getRecordTimeStamp()
 *
 * @method EngineCoolantTemperature setTemperatureInCelsius(float $temperature)
 * @method EngineCoolantTemperature setRecordTimeStamp(string $timeStamp)
 */
class EngineCoolantTemperature extends ModelAbstract
{

    protected $_allowedProperties = [
        "TemperatureInCelsius",
        "RecordTimeStamp"
    ];

}
