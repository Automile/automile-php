<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Exceptions\InvalidArgumentException;
use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleMilEvent Model
 *
 * @method string getOccured()
 * @method int getMILStatus()
 * @method int getMILDistance()
 * @method float getCLRDistanceUntilToday()
 * @method string getNumberOfDTCs()
 * @method float getLatitude()
 * @method float getLongitude()
 *
 * @method string setOccured(string $occured)
 * @method int setMILStatus(int $status)
 * @method int setMILDistance(int $distance)
 * @method float setCLRDistanceUntilToday(float $distance)
 * @method string setNumberOfDTCs(string $number)
 */
class MilEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'MILStatus',
        'MILDistance',
        'CLRDistanceUntilToday',
        'NumberOfDTCs',
        'Latitude',
        'Longitude'
    ];

    /**
     * @param float $lat
     * @return MilEvent
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
     * @return MilEvent
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
