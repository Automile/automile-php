<?php

namespace Automile\Sdk\Models;

/**
 * TripGeo Model
 * @package Automile\Sdk\Models
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

}
