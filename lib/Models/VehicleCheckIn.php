<?php

namespace Automile\Sdk\Models;

/**
 * Class VehicleCheckIn
 * @package Automile\Sdk\Models
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

}
