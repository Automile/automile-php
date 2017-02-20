<?php

namespace Automile\Sdk\Models;

/**
 * VehiclePlace Model
 * @package Automile\Sdk\Models
 * @method int getVehiclePlaceId()
 * @method int getVehicleId()
 * @method string getDescription()
 * @method int getTripType()
 * @method int getTripTypeTrigger()
 * @method int getRadius()
 * @method int getDrivesBetweenAnotherPlaceId()
 */
class VehiclePlace extends ModelAbstract
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
