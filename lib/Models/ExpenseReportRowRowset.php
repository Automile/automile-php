<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportRow Rowset Model
 */
class ExpenseReportRowRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return ExpenseReportRow
     */
    public function getModel($properties)
    {
        return new ExpenseReportRow($properties);
    }

}
