<?php

namespace Automile\Sdk\Models;

/**
 * Contact Rowset Model
 * @package Automile\Sdk\Models
 */
class ContactRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Contact
     */
    public function getModel($properties)
    {
        return new Contact($properties);
    }
}
