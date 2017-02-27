<?php

namespace Automile\Sdk\Models;

/**
 * VehicleDtcEvent Model
 */
class VehicleDtcEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        'Occured',
        'DTCEventDetails',
        'Latitude',
        'Longitude'
    ];

    /**
     * @param array|object $event
     * @return VehicleDtcEvent
     */
    public function setDTCEventDetails($event)
    {
        if (!is_object($event) || !$event instanceof VehicleDtcEventDetailRowset) {
            $event = new VehicleDtcEventDetailRowset($event);
        }

        $this->_properties['DTCEventDetails'] = $event;
        return $this;
    }

}
