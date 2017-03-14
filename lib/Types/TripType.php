<?php

namespace Automile\Sdk\Types;


/**
 * TripType
 */
class TripType implements Type
{

    const BUSINESS = 0;
    const PERSONAL = 1;
    const OTHER = 2;
    const AUTO = 3;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, range(0, 3));
    }

}
