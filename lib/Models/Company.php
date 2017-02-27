<?php

namespace Automile\Sdk\Models;

/**
 * Company Model
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
