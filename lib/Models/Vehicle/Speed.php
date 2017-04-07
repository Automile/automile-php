<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleSpeed Model
 * 
 * @method float getSpeedKmPerHour()
 * @method \DateTime getRecordTimeStamp()
 *
 * @method Speed setSpeedKmPerHour(float $speed)
 */
class Speed extends ModelAbstract
{

    protected $_allowedProperties = [
        "SpeedKmPerHour",
        "RecordTimeStamp"
    ];

    /**
     * @param string|\DateTime $date
     * @return Speed
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
