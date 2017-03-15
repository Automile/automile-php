<?php

namespace Automile\Sdk\Types;

/**
 * VehicleDefectStatus Type
 */
class VehicleDefectStatusType implements Type
{

    const NOT_RESOLVED = 0;
    const RESOLVED = 1;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, range(0, 1));
    }

}
