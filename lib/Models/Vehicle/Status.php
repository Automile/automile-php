<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle2Status Model
 * 
 * @method int getVehicleId()
 * @method string getLastPositionUtc()
 * @method float getLastKnownLatitude()
 * @method float getLastKnownLongitude()
 * @method bool getIsDriving()
 * @method string getMakeImageUrl()
 * @method int getParkedForNumberOfSeconds()
 * @method int getDrivingForNumberOfSeconds()
 * @method string getLastKnownFormattedAddress()
 * @method string getLastKnownStreetAddress()
 * @method string getLastKnownCity()
 * @method int getLastTripId()
 * @method int getLastLocationType()
 *
 * @method int setVehicleId(int $vehicleId)
 * @method string setLastPositionUtc(string $position)
 * @method float setLastKnownLatitude(float $lat)
 * @method float setLastKnownLongitude(float $lng)
 * @method bool setIsDriving(bool $isDriving)
 * @method string setMakeImageUrl(string $url)
 * @method int setParkedForNumberOfSeconds(int $seconds)
 * @method int setDrivingForNumberOfSeconds(int $seconds)
 * @method string setLastKnownFormattedAddress(string $address)
 * @method string setLastKnownStreetAddress(string $address)
 * @method string setLastKnownCity(string $city)
 * @method int setLastTripId(int $tripId)
 * @method int setLastLocationType(int $locationType)
 */
class Status extends ModelAbstract
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
        "LastKnownCity",
        "LastTripId",
        "LastLocationType"
    ];

}
