<?php

namespace Automile\Sdk\Models;

/**
 * AmbientAirTemperature Model
 *
 * @method float getTemperatureInCelsius()
 * @method \DateTime getRecordTimeStamp()
 *
 * @method AmbientAirTemperature setTemperatureInCelsius(float $rpm)
 */
class AmbientAirTemperature extends ModelAbstract
{

    protected $_allowedProperties = [
        "TemperatureInCelsius",
        "RecordTimeStamp"
    ];

    /**
     * @param string|\DateTime $date
     * @return AmbientAirTemperature
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
