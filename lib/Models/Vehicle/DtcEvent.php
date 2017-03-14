<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Exceptions\InvalidArgumentException;
use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleDtcEvent Model
 *
 * @method string getOccured()
 * @method DtcEventDetailRowset getDTCEventDetails()
 * @method float getLatitude()
 * @method float getLongitude()
 *
 * @method DtcEvent setOccured(string $occured)
 */
class DtcEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'DTCEventDetails',
        'Latitude',
        'Longitude'
    ];

    /**
     * @param array|object $event
     * @return DtcEvent
     */
    public function setDTCEventDetails($event)
    {
        if (!is_object($event) || !$event instanceof DtcEventDetailRowset) {
            $event = new DtcEventDetailRowset($event);
        }

        $this->_properties['DTCEventDetails'] = $event;
        return $this;
    }

    /**
     * @param float $lat
     * @return DtcEvent
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
     * @return DtcEvent
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
