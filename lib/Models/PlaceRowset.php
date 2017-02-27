<?php

namespace Automile\Sdk\Models;

/**
 * Place Rowset Model
 */
class PlaceRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return Place
     */
    public function getModel($properties)
    {
        return new Place($properties);
    }
}
