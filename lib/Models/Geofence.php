<?php

namespace Automile\Sdk\Models;

/**
 * Geofence Model
 * 
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
     * @return Geofence
     */
    public function setGeofencePolygon($rows)
    {
        if (!is_object($rows) || !$rows instanceof GeofencePolygon) {
            $rows = new GeofencePolygon($rows);
        }

        $this->_properties['GeofencePolygon'] = $rows;

        return $this;
    }

}
