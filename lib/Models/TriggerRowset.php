<?php

namespace Automile\Sdk\Models;

/**
 * Trigger Rowset Model
 */
class TriggerRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Trigger
     */
    public function getModel($properties)
    {
        return new Trigger($properties);
    }

}
