<?php

namespace Automile\Sdk\Models;

/**
 * Geofence Model
 * @package Automile\Sdk\Models
 * @method int getGeofenceId()
 * @method string getName()
 * @method string getDescription()
 * @method int getVehicleId()
 * @method GeofencePolygon getGeofencePolygon()
 */
class Geofence extends ModelAbstract
{

    protected $_allowedProperties = [
        "GeofenceId",
        "Name",
        "Description",
        "VehicleId",
        "GeofencePolygon",
        "IsEditable",
        "GeofenceType",
        "Schedules"
    ];

    /**
     * @param array|object $rows
     * @return $this
     */
    public function setGeofencePolygon($rows)
    {
        $rows = (array)$rows;
        $this->_properties['GeofencePolygon'] = new GeofencePolygon(empty($rows['Coordinates']) ? [] : $rows['Coordinates']);
        return $this;
    }

}