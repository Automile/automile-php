<?php

namespace Automile\Sdk\Models\Report;


use Automile\Sdk\Models\ModelAbstract;

/**
 * Fuel Report Model
 *
 * @method float getBusinessFuelInLiters()
 * @method float getPersonalFuelInLiters()
 * @method float getOtherFuelInLiters()
 * @method int getPeriod()
 *
 * @method Distance setBusinessFuelInLiters(float $liters)
 * @method Distance setPersonalFuelInLiters(float $liters)
 * @method Distance setOtherFuelInLiters(float $liters)
 * @method Distance setPeriod(int $period)
 */
class Fuel extends ModelAbstract
{

    /**
     * list of properties allowed for auto assignment
     * @var array
     */
    protected $_allowedProperties = [
        'BusinessFuelInLiters',
        'PersonalFuelInLiters',
        'OtherFuelInLiters',
        'Period'
    ];

}
