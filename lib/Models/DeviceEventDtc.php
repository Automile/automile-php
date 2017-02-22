<?php

namespace Automile\Sdk\Models;

/**
 * DeviceEventDtc Model
 * @package Automile\Sdk\Models
 *
 * @method DeviceDtcRowset getDtcs()
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
 * @method DeviceEventDtc setDescription(string $description)
 * @method DeviceEventDtc setTimeStamp(string $timeStamp)
 * @method DeviceEventDtc setTimeZone(int $timeZone)
 * @method DeviceEventDtc setEventType(string $eventType)
 * @method DeviceEventDtc setPositionLongitude(float $longitude)
 * @method DeviceEventDtc setPositionLatitude(float $latitude)
 * @method DeviceEventDtc setPositionFormattedAddress(string $address)
 * @method DeviceEventDtc setCellTower(int $cellTower)
 * @method DeviceEventDtc setCellTowerTimeZone(int $cellTowerTimeZone)
 * @method DeviceEventDtc setVehicleIdentificationNumber(string $vin)
 * @method DeviceEventDtc setIMEI(string $imei)
 * @method DeviceEventDtc setDeviceSerialNumber(string $serialNumber)
 */
class DeviceEventDtc extends ModelAbstract
{

    protected $_allowedProperties = [
        "Dtcs",
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

    /**
     * @param array|object $dtcs
     * @return DeviceEventDtc
     */
    public function setDtcs($dtcs)
    {
        if (!is_object($dtcs) || !$dtcs instanceof DeviceDtcRowset) {
            $dtcs = new DeviceDtcRowset($dtcs);
        }

        $this->_properties['Dtcs'] = $dtcs;
        return $this;
    }

}
