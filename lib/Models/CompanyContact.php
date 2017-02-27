<?php

namespace Automile\Sdk\Models;

/**
 * CompanyContact Model
 * @method int getCompanyContactId()
 */
class CompanyContact extends ModelAbstract
{

    protected $_allowedProperties = [
        "CompanyContactId",
        "CompanyId",
        "CompanyName",
        "ContactId",
        "ContactName",
        "Scopes"
    ];

}
