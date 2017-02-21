<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Models\ExpenseReportRowset;
use Automile\Sdk\Models\ExpenseReport as ExpenseReportModel;

/**
 * ExpenseReport API Queries
 * @package Automile\Sdk\Endpoints
 */
trait ExpenseReport
{

    protected $_expenseReportUri = '/v1/resourceowner/expensereport';

    /**
     * Get a list of expense reports
     * @return ExpenseReportRowset
     */
    public function getExpenseReports()
    {
        return $this->_getAll($this->_expenseReportUri, new ExpenseReportRowset());
    }

    /**
     * Get the details about a specific expense report
     * @param int $id
     * @return ExpenseReportModel
     */
    public function getExpenseReportById($id)
    {
        return $this->_getById($this->_expenseReportUri, $id, new ExpenseReportModel());
    }

}
