<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportRowContent Rowset Model
 * @package Automile\Sdk\Models
 */
class ExpenseReportRowContentRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return ExpenseReportRowContent
     */
    public function getModel($properties)
    {
        return new ExpenseReportRowContent($properties);
    }

}
