<?php

namespace Automile\Sdk\Models;

/**
 * VehicleBatteryEvent Model
 * @package Automile\Sdk\Models
 */
class VehicleBatteryEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'Latitude',
        'Longitude',
        'BatteryStatus'
    ];

}
