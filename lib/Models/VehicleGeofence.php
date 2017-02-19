<?php

namespace Automile\Sdk\Models;

/**
 * VehicleGeofence Model
 * @package Automile\Sdk\Models
 * @method int getVehicleGeofenceId()
 * @method int getVehicleId()
 * @method int getGeofenceId()
 * @method string getValidFrom()
 * @method string getValidTo()
 */
class VehicleGeofence extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleGeofenceId",
        "VehicleId",
        "GeofenceId",
        "ValidFrom",
        "ValidTo"
    ];

}
