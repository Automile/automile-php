<?php

namespace Automile\Sdk\Models;

/**
 * Geofence Report Model
 *
 * @method GeofenceReport setVehicleId(int $vehicleId)
 * @method GeofenceReport setGeofenceId(int $geofenceId)
 *
 * @method int getVehicleId()
 * @method int getGeofenceId()
 * @method GeofenceReportRecordRowset getResult()
 * @method DateTime getFromDate()
 * @method DateTime getToDate()
 */
class GeofenceReport extends ModelAbstract
{

    protected $_allowedProperties = [
        'FromDate',
        'ToDate',
        'VehicleId',
        'GeofenceId',
        'Result'
    ];

    /**
     * @param string|\DateTime $date
     * @return GeofenceReport
     */
    public function setFromDate($date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date, new \DateTimeZone('UTC'));
        }
        $this->_properties['FromDate'] = $date;

        return $this;
    }

    /**
     * @param string|\DateTime $date
     * @return GeofenceReport
     */
    public function setToDate($date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date, new \DateTimeZone('UTC'));
        }
        $this->_properties['ToDate'] = $date;

        return $this;
    }

    /**
     * @param array|object $rows
     * @return GeofenceReport
     */
    public function setResult($rows)
    {
        if (!is_object($rows) || !$rows instanceof GeofenceReportRecordRowset) {
            $rows = new GeofenceReportRecordRowset($rows);
        }

        $this->_properties['Result'] = $rows;
        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['FromDate'])) {
            $values['FromDate'] = $values['FromDate']->format('c');
        }

        if (!empty($values['ToDate'])) {
            $values['ToDate'] = $values['ToDate']->format('c');
        }

        return $values;
    }

}
