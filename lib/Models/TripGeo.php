<?php

namespace Automile\Sdk\Models;

/**
 * TripGeo Model
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
