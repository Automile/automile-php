<?php

namespace Automile\Sdk\Models;

/**
 * VehicleBatteryEvent Model
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
