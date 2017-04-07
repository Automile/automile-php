<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;
use Automile\Sdk\Types\FuelType;

/**
 * Vehicle Tiny Model
 *
 * @see FuelType
 *
 * @method int getVehicleId()
 * @method string getNumberPlate()
 * @method string getMake()
 * @method string getModel()
 * @method string getFriendlyName()
 * @method int getFuelType(),
 * @method int getModelYear(),
 * @method string getImageUrlMake()
 * @method string getUserFriendlyName()
 *
 * @method Tiny setVehicleId(int $vehicleId)
 * @method Tiny setNumberPlate(string $plate)
 * @method Tiny setMake(string $make)
 * @method Tiny setModel(string $model)
 * @method Tiny setFriendlyName(string $name)
 * @method Tiny setFuelType(int $fuelType),
 * @method Tiny setModelYear(int $modelYear),
 * @method Tiny setImageUrlMake(string $url)
 * @method Tiny setUserFriendlyName(string $name)
 */
class Tiny extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleId",
        "NumberPlate",
        "Make",
        "Model",
        "FriendlyName",
        "FuelType",
        "ModelYear",
        "ImageUrlMake",
        "UserFriendlyName"
    ];

}
