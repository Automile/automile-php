<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportRowContent Rowset Model
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
