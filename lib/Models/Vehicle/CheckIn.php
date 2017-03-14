<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;
use Automile\Sdk\Models\ModelException;
use Automile\Sdk\Types\DeviceType;
use Automile\Sdk\Types\TripType;

/**
 * Class VehicleCheckIn
 *
 * @see TripType
 * @see DeviceType
 *
 * @method int getContactId()
 * @method int getVehicleId()
 * @method int getDefaultTripType()
 * @method int getUserDeviceType()
 * @method string getUserDeviceToken()
 *
 * @method CheckIn setContactId(int $contactId)
 * @method CheckIn setVehicleId(int $vehicleId)
 * @method CheckIn setUserDeviceToken(string $token)
 */
class CheckIn extends ModelAbstract
{

    protected $_allowedProperties = [
        "ContactId",
        "VehicleId",
        "DefaultTripType",
        "CheckOutAtUtc",
        "UserDeviceType",
        "UserDeviceToken"
    ];

    /**
     * @see TripType
     * @param string $tripType
     * @return CheckIn
     * @throws ModelException
     */
    public function setDefaultTripType($tripType)
    {
        if (!TripType::isValid($tripType)) {
            throw new ModelException("Trip Type value is out of range");
        }

        $this->_properties['DefaultTripType'] = $tripType;

        return $this;
    }

    /**
     * @see DeviceType
     * @param string $deviceType
     * @return CheckIn
     * @throws ModelException
     */
    public function setUserDeviceType($deviceType)
    {
        if (!DeviceType::isValid($deviceType)) {
            throw new ModelException("Device Type value is out of range");
        }

        $this->_properties['UserDeviceType'] = $deviceType;

        return $this;
    }

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return CheckIn
     */
    public function setCheckOutAtUtc($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['CheckOutAtUtc'] = $dateTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCheckOutAtUtc()
    {
        return empty($this->_properties['CheckOutAtUtc']) ? null : $this->_properties['CheckOutAtUtc'];
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['CheckOutAtUtc'])) {
            $values['CheckOutAtUtc'] = $values['CheckOutAtUtc']->format('c');
        }

        return $values;
    }

}
