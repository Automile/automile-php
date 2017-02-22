<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Types\TripTypeTriggerType;

/**
 * Place Model
 * @package Automile\Sdk\Models
 * @method GeographicPosition getPositionPoint()
 * @method int getPlaceId()
 * @method string getName()
 * @method string getDescription
 * @method int getTripType()
 * @method int getTripTypeTrigger
 * @method bool getDrivesBetweenAnotherPlaceId()
 */
class Place extends ModelAbstract
{

    protected $_allowedProperties = [
        "PlaceId",
        "Name",
        "Description",
        "PositionPoint",
        "TripType",
        "TripTypeTrigger",
        "Radius",
        "IsEditable",
        "VehicleId",
        "DrivesBetweenAnotherPlaceId"
    ];

    /**
     * @param array|object $property
     * @return Place
     */
    public function setPositionPoint($property)
    {
        if (!is_object($property) || !$property instanceof GeographicPosition) {
            $property = new GeographicPosition($property);
        }

        $this->_properties['PositionPoint'] = $property;
        return $this;
    }

    /**
     * @return bool
     * @throws ModelValidatorException
     */
    public function isValid()
    {
        if ($this->getTripTypeTrigger() == TripTypeTriggerType::DRIVES_BETWEEN && !$this->getDrivesBetweenAnotherPlaceId()) {
            throw new ModelValidatorException('You need to enter the second place when you select the drives between type, use the DrivesBetweenAnotherPlaceId property');
        }

        if ($this->getTripTypeTrigger() != TripTypeTriggerType::DRIVES_BETWEEN && $this->getDrivesBetweenAnotherPlaceId()) {
            throw new ModelValidatorException("You can't use DrivesBetweenAnotherPlaceId property if the TripTypeTrigger is null or isnt't equal to DrivesBetween type");
        }

        return true;
    }

}
