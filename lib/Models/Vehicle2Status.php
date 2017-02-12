<?php

namespace Automile\Sdk\Models;

/**
 * Vehicle2Status Model
 * @package Automile\Sdk\Models
 * @method int getVehicleId()
 */
class Vehicle2Status extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleId",
        "LastPositionUtc",
        "LastKnownLatitude",
        "LastKnownLongitude",
        "IsDriving",
        "MakeImageUrl",
        "ParkedForNumberOfSeconds",
        "DrivingForNumberOfSeconds",
        "LastKnownFormattedAddress",
        "LastKnownStreetAddress",
        "LastKnownCity"
    ];

}