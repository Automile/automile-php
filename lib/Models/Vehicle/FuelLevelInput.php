<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleFuelLevelInput Model
 *
 * @method float getFuelLevelInPercentage()
 * @method \DateTime getRecordTimeStamp()
 *
 * @method FuelLevelInput setFuelLevelInPercentage(float $fuelLevel)
 */
class FuelLevelInput extends ModelAbstract
{

    protected $_allowedProperties = [
        "FuelLevelInPercentage",
        "RecordTimeStamp"
    ];

    /**
     * @param string|\DateTime $date
     * @return FuelLevelInput
     */
    public function setRecordTimeStamp($date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date, new \DateTimeZone('UTC'));
        }
        $this->_properties['RecordTimeStamp'] = $date;

        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['RecordTimeStamp'])) {
            $values['RecordTimeStamp'] = $values['RecordTimeStamp']->format('c');
        }

        return $values;
    }

}
