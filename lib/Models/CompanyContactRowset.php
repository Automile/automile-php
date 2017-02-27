<?php

namespace Automile\Sdk\Models;

/**
 * CompanyContact Rowset Model
 */
class CompanyContactRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return CompanyContact
     */
    public function getModel($properties)
    {
        return new CompanyContact($properties);
    }

}
