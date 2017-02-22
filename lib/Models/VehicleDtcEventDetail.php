<?php

namespace Automile\Sdk\Models;

/**
 * VehicleDtcEventDetail Model
 * @package Automile\Sdk\Models
 */
class VehicleDtcEventDetail extends ModelAbstract
{

    protected $_allowedProperties = [
        'DTC',
        'FaultLocation',
        'ProbableCause'
    ];

}
