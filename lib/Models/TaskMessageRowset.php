<?php

namespace Automile\Sdk\Models;

/**
 * TaskMessage Rowset Model
 * @package Automile\Sdk\Models
 */
class TaskMessageRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TaskMessage
     */
    public function getModel($properties)
    {
        return new TaskMessage($properties);
    }

}
