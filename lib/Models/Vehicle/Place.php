<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehiclePlace Model
 * 
 * @method int getVehiclePlaceId()
 * @method int getVehicleId()
 * @method string getDescription()
 * @method int getTripType()
 * @method int getTripTypeTrigger()
 * @method int getRadius()
 * @method int getDrivesBetweenAnotherPlaceId()
 *
 * @method Place setVehiclePlaceId(int $placeId)
 * @method Place setVehicleId(int $vehicleId)
 * @method Place setDescription(string $description)
 * @method Place setTripType(int $tripType)
 * @method Place setTripTypeTrigger(int $tripTypeTrigger)
 * @method Place setRadius(int $radius)
 * @method Place setDrivesBetweenAnotherPlaceId(int $placeId)
 */
class Place extends ModelAbstract
{
    
    protected $_allowedProperties = [
        "VehiclePlaceId",
        "VehicleId",
        "PlaceId",
        "Description",
        "TripType",
        "TripTypeTrigger",
        "Radius",
        "DrivesBetweenAnotherPlaceId"
    ];

}
