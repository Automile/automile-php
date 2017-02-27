<?php

namespace Automile\Sdk\Models;

/**
 * Contact Model
 */
class Contact extends ModelAbstract
{

    protected $_allowedProperties = [
        "ContactId",
        "FirstName",
        "LastName",
        "EmailAddress",
        "MobilePhoneNumber",
        "ProfileImageUrl",
        "CheckedInDateTimeUtc",
        "CheckedIntoVehicleId",
        "IsManager",
        "CompanyRoles",
        "CurrencyCode"
    ];

}
