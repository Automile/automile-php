<?php

namespace Automile\Sdk\Models;

/**
 * GeofencePolygon Model
 */
class GeofencePolygon extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return GeographicPosition
     */
    public function getModel($properties)
    {
        return new GeographicPosition($properties);
    }

    /**
     * Export the object data into an array
     * @return array
     */
    public function toArray()
    {
        return ['Coordinates' => parent::toArray()];
    }

}
