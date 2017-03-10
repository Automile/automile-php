<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelAbstract;

/**
 * IdleTime Report Model
 *
 * @method int getBusinessIdleTimeInMinutes()
 * @method int getPersonalIdleTimeInMinutes()
 * @method int getOtherIdleTimeInMinutes()
 * @method int getPeriod()
 *
 * @method CO2 setBusinessIdleTimeInMinutes(int $grams)
 * @method CO2 setPersonalIdleTimeInMinutes(int $grams)
 * @method CO2 setOtherIdleTimeInMinutes(int $grams)
 * @method CO2 setPeriod(int $period)
 */
class IdleTime extends ModelAbstract
{

    protected $_allowedProperties = [
        'BusinessIdleTimeInMinutes',
        'PersonalIdleTimeInMinutes',
        'OtherIdleTimeInMinutes',
        'Period'
    ];

}
