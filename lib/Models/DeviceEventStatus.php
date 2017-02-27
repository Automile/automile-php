<?php

namespace Automile\Sdk\Models;

/**
 * DeviceEventStatus Model
 *
 * @method string getStatus()
 * @method string getDescription()
 * @method string getTimeStamp()
 * @method int getTimeZone()
 * @method string getEventType()
 * @method float getPositionLongitude()
 * @method float getPositionLatitude()
 * @method string getPositionFormattedAddress()
 * @method int getCellTower()
 * @method int getCellTowerTimeZone()
 * @method string getVehicleIdentificationNumber()
 * @method string getIMEI()
 * @method string getDeviceSerialNumber()
 *
 * @method string setStatus(string $status)
 * @method string setDescription(string $description)
 * @method string setTimeStamp(string $timeStamp)
 * @method int setTimeZone(int $timeZone)
 * @method string setEventType(string $eventType)
 * @method float setPositionLongitude(float $longitude)
 * @method float setPositionLatitude(float $latitude)
 * @method string setPositionFormattedAddress(string $address)
 * @method int setCellTower(int $cellTower)
 * @method int setCellTowerTimeZone(int $cellTowerTimeZone)
 * @method string setVehicleIdentificationNumber(string $vin)
 * @method string setIMEI(string $imei)
 * @method string setDeviceSerialNumber(string $serialNumber)
 */
class DeviceEventStatus extends ModelAbstract
{

    protected $_allowedProperties = [
        "Status",
        "Description",
        "TimeStamp",
        "TimeZone",
        "EventType",
        "PositionLongitude",
        "PositionLatitude",
        "PositionFormattedAddress",
        "CellTower",
        "CellTowerTimeZone",
        "VehicleIdentificationNumber",
        "IMEI",
        "DeviceSerialNumber"
    ];

}
