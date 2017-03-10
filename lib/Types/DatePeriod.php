<?php

namespace Automile\Sdk\Types;

/**
 * DatePeriod
 */
class DatePeriod
{

    const FORMAT = '/^\d{4}(?:\d{2})?(?:\-\d{4}(?:\d{2}))?$/';

    /**
     * @param string $datePeriod
     * @return bool
     */
    public static function isValid($datePeriod)
    {
        return (bool)preg_match(self::FORMAT, $datePeriod);
    }

}
