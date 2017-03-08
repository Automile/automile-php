<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportEmail Model
 *
 * @method string getToEmail()
 * @method string getISO639LanguageCode()
 *
 * @method ExpenseReportEmail setToEmail(string $email)
 * @method ExpenseReportEmail setISO639LanguageCode(string $code)
 */
class ExpenseReportEmail extends ModelAbstract
{

    protected $_allowedProperties = [
        'ToEmail',
        'ISO639LanguageCode'
    ];

}
