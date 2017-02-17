<?php

namespace Automile\Sdk\Models;

/**
 * Company Model
 * @package Automile\Sdk\Models
 * @method int getCompanyId()
 */
class Company extends ModelAbstract
{

    protected $_allowedProperties = [
        "CompanyId",
        "RegisteredCompanyName",
        "RegistrationNumber",
        "Description",
        "LastModified",
        "Created",
        "CreateRelationshipToContactId"
    ];

}
