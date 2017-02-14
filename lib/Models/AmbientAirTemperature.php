<?php

namespace Automile\Sdk\Models;

/**
 * AmbientAirTemperature Model
 * @package Automile\Sdk\Models
 */
class AmbientAirTemperature extends ModelAbstract
{

    protected $_allowedProperties = [
        "TemperatureInCelsius",
        "RecordTimeStamp"
    ];

}
