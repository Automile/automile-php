<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleDtcEventDetail Model
 *
 * @method string getDTC()
 * @method string getFaultLocation()
 * @method string getProbableCause()
 *
 * @method DtcEventDetail setDTC(string $dtc)
 * @method DtcEventDetail setFaultLocation(string $faultLocation)
 * @method DtcEventDetail setProbableCause(string $probableCause)
 */
class DtcEventDetail extends ModelAbstract
{

    protected $_allowedProperties = [
        'DTC',
        'FaultLocation',
        'ProbableCause'
    ];

}
