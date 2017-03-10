<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelAbstract;

/**
 * CO2 Report Model
 *
 * @method float getBusinessCO2InGrams()
 * @method float getPersonalCO2InGrams()
 * @method float getOtherCO2InGrams()
 * @method int getPeriod()
 *
 * @method CO2 setBusinessCO2InGrams(float $grams)
 * @method CO2 setPersonalCO2InGrams(float $grams)
 * @method CO2 setOtherCO2InGrams(float $grams)
 * @method CO2 setPeriod(int $period)
 */
class CO2 extends ModelAbstract
{

    /**
     * list of properties allowed for auto assignment
     * @var array
     */
    protected $_allowedProperties = [
        'BusinessCO2InGrams',
        'PersonalCO2InGrams',
        'OtherCO2InGrams',
        'Period'
    ];

}
