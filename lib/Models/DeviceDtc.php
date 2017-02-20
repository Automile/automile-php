<?php

namespace Automile\Sdk\Models;

/**
 * DeviceDtc Model
 * @package Automile\Sdk\Models
 *
 * @method string getDTCCode()
 * @method string getFaultLocation()
 * @method string getProbableCause()
 *
 * @method DeviceDtc setDTCCode(string $dtcCode)
 * @method DeviceDtc setFaultLocation(string $faultLocation)
 * @method DeviceDtc setProbableCause(string $probableCause)
 */
class DeviceDtc extends ModelAbstract
{

    protected $_allowedProperties = [
        "DTCCode",
        "FaultLocation",
        "ProbableCause"
    ];

}
