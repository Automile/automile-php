<?php

namespace Automile\Sdk\Models;

/**
 * Device Model
 * @package Automile\Sdk\Models
 * @method int getIMEIConfigId()
 * @method Device setIMEIConfigId($id)
 * @method string getIMEI()
 * @method Device setIMEI($imei)
 * @method int getVehicleId()
 * @method Device setVehicleId($vehicleId)
 * @method int getDeviceType()
 * @method Device setDeviceType()
 */
class Device extends ModelAbstract
{

    protected $_allowedProperties = [
        "IMEIConfigId",
        "IMEI",
        "VehicleId",
        "DeviceType",
        "SerialNumber",
        "IMEIDeviceType"
    ];

}
