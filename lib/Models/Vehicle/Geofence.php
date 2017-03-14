<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleGeofence Model
 * 
 * @method int getVehicleGeofenceId()
 * @method int getVehicleId()
 * @method int getGeofenceId()
 * @method string getValidFrom()
 * @method string getValidTo()
 *
 * @method Geofence setVehicleGeofenceId(int $vehicleGeofenceId)
 * @method Geofence setVehicleId(int $vehicleId)
 * @method Geofence setGeofenceId(int $geofenceId)
 * @method Geofence setValidFrom(string $validFrom)
 * @method Geofence setValidTo(string $validTo)
 */
class Geofence extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleGeofenceId",
        "VehicleId",
        "GeofenceId",
        "ValidFrom",
        "ValidTo"
    ];

}
