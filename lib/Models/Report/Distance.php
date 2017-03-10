<?php

namespace Automile\Sdk\Models\Report;


use Automile\Sdk\Models\ModelAbstract;

/**
 * Distance Report Model
 *
 * @method float getBusinessDistanceInKilometers()
 * @method float getPersonalDistanceInKilometers()
 * @method float getOtherDistanceInKilometers()
 * @method int getPeriod()
 *
 * @method Distance setBusinessDistanceInKilometers(float $distance)
 * @method Distance setPersonalDistanceInKilometers(float $distance)
 * @method Distance setOtherDistanceInKilometers(float $distance)
 * @method Distance setPeriod(int $period)
 */
class Distance extends ModelAbstract
{

    /**
     * list of properties allowed for auto assignment
     * @var array
     */
    protected $_allowedProperties = [
        'BusinessDistanceInKilometers',
        'PersonalDistanceInKilometers',
        'OtherDistanceInKilometers',
        'Period'
    ];

}
