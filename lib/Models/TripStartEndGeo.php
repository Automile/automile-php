<?php

namespace Automile\Sdk\Models;

/**
 * TripStartEndGeo Model
 */
class TripStartEndGeo extends ModelAbstract
{

    protected $_allowedProperties = [
        "StartLatitude",
        "StartLongitude",
        "EndLatitude",
        "EndLongitude"
    ];

}
