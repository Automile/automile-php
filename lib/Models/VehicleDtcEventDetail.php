<?php

namespace Automile\Sdk\Models;

/**
 * VehicleDtcEventDetail Model
 */
class VehicleDtcEventDetail extends ModelAbstract
{

    protected $_allowedProperties = [
        'DTC',
        'FaultLocation',
        'ProbableCause'
    ];

}
