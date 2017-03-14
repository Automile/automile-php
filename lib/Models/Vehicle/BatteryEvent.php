<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Exceptions\InvalidArgumentException;
use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleBatteryEvent Model
 *
 * @see \Automile\Sdk\Types\BatteryEventStatusType
 *
 * @method string getOccured()
 * @method float getLatitude()
 * @method float getLongitude()
 * @method int getBatteryStatus()
 *
 * @method BatteryEvent setOccured(string $occured)
 * @method BatteryEvent setBatteryStatus(int $status)
 */
class BatteryEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'Latitude',
        'Longitude',
        'BatteryStatus'
    ];

    /**
     * @param float $lat
     * @return BatteryEvent
     * @throws InvalidArgumentException
     */
    public function setLatitude($lat)
    {
        if ($lat > 90 || $lat < -90) {
            throw new InvalidArgumentException("Latitude should be in range [-90, 90]");
        }

        $this->_properties['Latitude'] = $lat;

        return $this;
    }

    /**
     * @param float $lng
     * @return BatteryEvent
     * @throws InvalidArgumentException
     */
    public function setLongitude($lng)
    {
        if ($lng > 180 || $lng < -180) {
            throw new InvalidArgumentException("Longitude should be in range [-180, 180]");
        }

        $this->_properties['Longitude'] = $lng;

        return $this;
    }

}
