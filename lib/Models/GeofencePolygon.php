<?php

namespace Automile\Sdk\Models;

/**
 * GeofencePolygon Model
 * @package Automile\Sdk\Models
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

    public function toArray()
    {
        return ['Coordinates' => parent::toArray()];
    }

}
