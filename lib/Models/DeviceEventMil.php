<?php

namespace Automile\Sdk\Models;

/**
 * DeviceEventMil Model
 *
 * @method bool getMilStatus(),
 * @method int getNumberOfDTCs(),
 * @method int getMILDistance(),
 * @method int getCLRDistance(),
 * @method int getTripDistance(),
 * @method int getMILTime(),
 * @method int getCLRTime(),
 * @method int getTripTime(),
 * @method string getDescription(),
 * @method string getTimeStamp(),
 * @method int getTimeZone(),
 * @method string getEventType(),
 * @method float getPositionLongitude(),
 * @method float getPositionLatitude(),
 * @method string getPositionFormattedAddress(),
 * @method int getCellTower(),
 * @method int getCellTowerTimeZone(),
 * @method string getVehicleIdentificationNumber(),
 * @method string getIMEI(),
 * @method string getDeviceSerialNumber()
 *
 * @method DeviceEventMil setMilStatus(bool $status),
 * @method DeviceEventMil setNumberOfDTCs(int $number),
 * @method DeviceEventMil setMILDistance(int $distance),
 * @method DeviceEventMil setCLRDistance(int $distance),
 * @method DeviceEventMil setTripDistance(int $distance),
 * @method DeviceEventMil setMILTime(int $time),
 * @method DeviceEventMil setCLRTime(int $time),
 * @method DeviceEventMil setTripTime(int $time),
 * @method DeviceEventMil setDescription(string $description),
 * @method DeviceEventMil setTimeStamp(string $timeStamp),
 * @method DeviceEventMil setTimeZone(int $timeZone),
 * @method DeviceEventMil setEventType(string $eventType),
 * @method DeviceEventMil setPositionLongitude(float $longitude),
 * @method DeviceEventMil setPositionLatitude(float $latitude),
 * @method DeviceEventMil setPositionFormattedAddress(string $address),
 * @method DeviceEventMil setCellTower(int $tower),
 * @method DeviceEventMil setCellTowerTimeZone(int $towerTimeZone),
 * @method DeviceEventMil setVehicleIdentificationNumber(string $vin),
 * @method DeviceEventMil setIMEI(string $imei),
 * @method DeviceEventMil setDeviceSerialNumber(string $serialNumber)
 */
class DeviceEventMil extends ModelAbstract
{

    protected $_allowedProperties = [
        "MilStatus",
        "NumberOfDTCs",
        "MILDistance",
        "CLRDistance",
        "TripDistance",
        "MILTime",
        "CLRTime",
        "TripTime",
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
