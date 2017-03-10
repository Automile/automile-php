<?php

namespace Automile\Sdk\Models\Report;


use Automile\Sdk\Models\ModelAbstract;

/**
 * TravelTime Report Model
 *
 * @method int getBusinessTravelTimeInMinutes()
 * @method int getPersonalTravelTimeInMinutes()
 * @method int getOtherTravelTimeInMinutes()
 * @method int getPeriod()
 *
 * @method Distance setBusinessTravelTimeInMinutes(int $minutes)
 * @method Distance setPersonalTravelTimeInMinutes(int $minutes)
 * @method Distance setOtherTravelTimeInMinutes(int $minutes)
 * @method Distance setPeriod(int $period)
 */
class TravelTime extends ModelAbstract
{

    /**
     * list of properties allowed for auto assignment
     * @var array
     */
    protected $_allowedProperties = [
        'BusinessTravelTimeInMinutes',
        'PersonalTravelTimeInMinutes',
        'OtherTravelTimeInMinutes',
        'Period'
    ];

}
