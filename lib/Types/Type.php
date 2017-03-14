<?php

namespace Automile\Sdk\Types;

/**
 * Interface Type
 */
interface Type
{

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value);

}
