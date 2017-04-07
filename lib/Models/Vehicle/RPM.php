<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleRPM Model
 *
 * @method float getRPMValue()
 * @method \DateTime getRecordTimeStamp()
 *
 * @method RPM setRPMValue(float $rpm)
 */
class RPM extends ModelAbstract
{

    protected $_allowedProperties = [
        "RPMValue",
        "RecordTimeStamp"
    ];

    /**
     * @param string|\DateTime $date
     * @return RPM
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
