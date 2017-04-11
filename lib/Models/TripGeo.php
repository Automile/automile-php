<?php

namespace Automile\Sdk\Models;

/**
 * TripGeo Model
 *
 * @method \DateTime getRecordTimeStamp()
 * @method float getLatitude()
 * @method float getLongitude()
 * @method int getHeadingDegrees()
 * @method int getNumberOfSatellites()
 * @method int getHDOP()
 *
 * @method TripGeo setLatitude(float $lat)
 * @method TripGeo setLongitude(float $lng)
 * @method TripGeo setHeadingDegrees(int $degrees)
 * @method TripGeo setNumberOfSatellites(int $satellites)
 * @method TripGeo setHDOP(int $hdop)
 */
class TripGeo extends ModelAbstract
{

    protected $_allowedProperties = [
        "RecordTimeStamp",
        "Latitude",
        "Longitude",
        "HeadingDegrees",
        "NumberOfSatellites",
        "HDOP"
    ];

    /**
     * @param string|\DateTime $date
     * @return TripGeo
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
