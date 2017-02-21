<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReport Rowset Model
 * @package Automile\Sdk\Models
 */
class ExpenseReportRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return ExpenseReport
     */
    public function getModel($properties)
    {
        return new ExpenseReport($properties);
    }

}
