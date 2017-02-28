<?php

namespace Automile\Sdk\Models;

/**
 * Class VehicleCheckIn
 */
class VehicleCheckIn extends ModelAbstract
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
     * @param string $tripType
     * @return VehicleCheckIn
     * @throws ModelException
     */
    public function setDefaultTripType($tripType)
    {
        $allowedValues = [0, 1, 2, 3];
        if (!in_array($tripType, $allowedValues)) {
            throw new ModelException("Trip Type value is out of range, allowed values: [" . implode(', ', $allowedValues) . "]");
        }

        $this->_properties['DefaultTripType'] = $tripType;

        return $this;
    }

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return VehicleCheckIn
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
