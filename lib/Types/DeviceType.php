<?php

namespace Automile\Sdk\Types;

/**
 * Device Type
 */
class DeviceType implements Type
{

    const APPLE = 0;
    const ANDROID = 1;
    const WINDOWS_PHONE = 2;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, range(0, 2));
    }

}
