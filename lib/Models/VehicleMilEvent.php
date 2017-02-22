<?php

namespace Automile\Sdk\Models;

/**
 * VehicleMilEvent Model
 * @package Automile\Sdk\Models
 */
class VehicleMilEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'MILStatus',
        'MILDistance',
        'CLRDistanceUntilToday',
        'NumberOfDTCs',
        'Latitude',
        'Longitude'
    ];

}
