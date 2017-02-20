<?php

namespace Automile\Sdk\Endpoints;


use Automile\Sdk\Models\DeviceEventDtc;
use Automile\Sdk\Models\DeviceEventMil;
use Automile\Sdk\Models\DeviceEventRowset;
use Automile\Sdk\Models\DeviceEventStatus;

trait DeviceEvent
{

    protected $_deviceEventUri = '/v1/resourceowner/imeievents';

    /**
     * Get a list of all IMEIEvents that user is associated with
     * @return DeviceEventRowset
     */
    public function getDeviceEvents()
    {
        return $this->_getAll($this->_deviceEventUri, new DeviceEventRowset());
    }

    /**
     * Get a specific MIL (Mileage Indicator Lamp) event
     * @param int $deviceEventId
     * @return DeviceEventMil
     */
    public function getDeviceEventMILById($deviceEventId)
    {
        return $this->_getById($this->_deviceEventUri . '/mil', $deviceEventId, new DeviceEventMil());
    }

    /**
     * Get a specific DTC (Diagnostic Trouble Code) event
     * @param int $deviceEventId
     * @return DeviceEventDtc
     */
    public function getDeviceEventDTCById($deviceEventId)
    {
        return $this->_getById($this->_deviceEventUri . '/dtc', $deviceEventId, new DeviceEventDtc());
    }

    /**
     * Gets StatusIMEIevent for given imeiEventId
     * @param int $deviceEventId
     * @return DeviceEventStatus
     */
    public function getDeviceEventStatusById($deviceEventId)
    {
        return $this->_getById($this->_deviceEventUri . '/status', $deviceEventId, new DeviceEventStatus());
    }

}
