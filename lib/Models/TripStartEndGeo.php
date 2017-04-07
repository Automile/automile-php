<?php

namespace Automile\Sdk\Models;

/**
 * TripStartEndGeo Model
 *
 * @method float getStartLatitude()
 * @method float getStartLongitude()
 * @method float getEndLatitude()
 * @method float getEndLongitude()
 *
 * @method TripStartEndGeo setStartLatitude(float $lat)
 * @method TripStartEndGeo setStartLongitude(float $lng)
 * @method TripStartEndGeo setEndLatitude(float $lat)
 * @method TripStartEndGeo setEndLongitude(float $lng)
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
