<?php

namespace Automile\Sdk\Types;


class FuelType implements Type
{

    const DIESEL = 0;
    const PETROL = 1;
    const ETHANOL = 2;
    const GAS = 3;
    const HYBRID = 4;
    const ELECTRIC = 5;
    const METHANE = 6;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, range(0, 6));
    }

}
