<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * TripSummary Rowset Model
 */
class TripSummaryRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return TripSummary
     */
    public function getModel($properties)
    {
        return new TripSummary($properties);
    }

}
