<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Models\DeviceRowset;
use Automile\Sdk\Models\Device as DeviceModel;

/**
 * Device API Queries
 * @package Automile\Sdk\Endpoints
 */
trait Device
{

    protected $_deviceUri = '/v1/resourceowner/imeiconfigs';

    /**
     * Get all imeis (devices) that the logged in user has access to
     * @return DeviceRowset
     */
    public function getDevices()
    {
        return $this->_getAll($this->_deviceUri, new DeviceRowset());
    }

    /**
     * Get details for the device
     * @param $id
     * @return DeviceModel
     */
    public function getDeviceById($id)
    {
        return $this->_getById($this->_deviceUri, new DeviceModel(), $id);
    }

    /**
     * Creates a new IMEIConfig and associates it with vehicle
     * @param DeviceModel $device
     * @return DeviceModel
     */
    public function createDevice(DeviceModel $device)
    {
        return $this->_create($this->_deviceUri, $device);
    }

    /**
     * Updates the given IMEIConfig id
     * @param DeviceModel $device
     * @return DeviceModel
     */
    public function editDevice(DeviceModel $device)
    {
        if (!$device->getIMEIConfigId()) {
            throw new AutomileException('Device ID is empty');
        }

        return $this->_edit($this->_deviceUri, $device->getIMEIConfigId(), $device);
    }

    /**
     * Removes the given IMEI config
     * @param int $deviceId
     * @return bool
     */
    public function deleteDevice($deviceId)
    {
        return $this->_delete($this->_deviceUri, $deviceId);
    }

}
