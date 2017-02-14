<?php

namespace Automile\Sdk\Models;

/**
 * TripStartEndGeo Model
 * @package Automile\Sdk\Models
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
