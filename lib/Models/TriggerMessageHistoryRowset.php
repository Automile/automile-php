<?php

namespace Automile\Sdk\Models;

/**
 * TriggerMessageHistory Rowset Model
 * @package Automile\Sdk\Models
 */
class TriggerMessageHistoryRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TriggerMessageHistory
     */
    public function getModel($properties)
    {
        return new TriggerMessageHistory($properties);
    }
}
