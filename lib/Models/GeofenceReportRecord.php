<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Models\Vehicle\Tiny;
use Automile\Sdk\Types\GeofenceType;

/**
 * GeofenceReportRecord Model
 *
 * @see GeofenceType
 *
 * @method int getTripId()
 * @method int getGeofenceId()
 * @method string getGeofenceName()
 * @method int getGeofenceType()
 * @method bool getIsInside()
 * @method \DateTime getEventDateTime()
 * @method Tiny getVehicleTinyModel()
 *
 * @method GeofenceReportRecord setTripId(int $tripId)
 * @method GeofenceReportRecord setGeofenceId(int $geofenceId)
 * @method GeofenceReportRecord setGeofenceName(string $name)
 * @method GeofenceReportRecord setGeofenceType(int $type)
 * @method GeofenceReportRecord setIsInside(bool $isInside)
 * @method GeofenceReportRecord setEventDateTime(\DateTime $dateTime)
 */
class GeofenceReportRecord extends ModelAbstract
{
    
    protected $_allowedProperties = [
        "TripId",
        "GeofenceId",
        "GeofenceName",
        "GeofenceType",
        "IsInside",
        "EventDateTime",
        "VehicleTinyModel"
    ];

    /**
     * @param array|object $rows
     * @return GeofenceReportRecord
     */
    public function setVehicleTinyModel($model)
    {
        if (!is_object($model) || !$model instanceof Tiny) {
            $model = new Tiny($model);
        }

        $this->_properties['VehicleTinyModel'] = $model;
        return $this;
    }

}
