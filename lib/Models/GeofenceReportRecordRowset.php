<?php

namespace Automile\Sdk\Models;

/**
 * GeofenceReportRecord Rowset Model
 */
class GeofenceReportRecordRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return GeofenceReportRecord
     */
    public function getModel($properties)
    {
        return new GeofenceReportRecord($properties);
    }

}
