<?php

namespace Automile\Sdk\Models;

/**
 * Task Rowset Model
 */
class TaskRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Task
     */
    public function getModel($properties)
    {
        return new Task($properties);
    }

}
