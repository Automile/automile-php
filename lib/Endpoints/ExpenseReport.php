<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\ExpenseReportEmail;
use Automile\Sdk\Models\ExpenseReportRowset;
use Automile\Sdk\Models\ExpenseReport as ExpenseReportModel;
use Automile\Sdk\Models\ExpenseReportsEmail;

/**
 * ExpenseReport API Queries
 */
trait ExpenseReport
{

    private $_expenseReportUri = '/v1/resourceowner/expensereport';

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

    /**
     * Create an expense report
     * @param ExpenseReportModel $model
     * @return ExpenseReportModel
     */
    public function createExpenseReport(ExpenseReportModel $model)
    {
        return $this->_create($this->_expenseReportUri, $model);
    }

    /**
     * Updates the given expense report
     * @param ExpenseReportModel $model
     * @return ExpenseReportModel
     */
    public function editExpenseReport(ExpenseReportModel $model)
    {
        if (!$model->getExpenseReportId()) {
            throw new AutomileException('Expense Report ID is empty');
        }

        return $this->_edit($this->_expenseReportUri, $model->getExpenseReportId(), $model);
    }

    /**
     * @param int $expenseReportId
     * @param ExpenseReportEmail $model
     * @return bool
     * @throws AutomileException
     */
    public function emailExpenseReport($expenseReportId, ExpenseReportEmail $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_expenseReportUri . '/export/' . $expenseReportId)
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * @param ExpenseReportsEmail $model
     * @return bool
     * @throws AutomileException
     */
    public function emailExpenseReports(ExpenseReportsEmail $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_expenseReportUri . '/export/')
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteExpenseReport($id)
    {
        return $this->_delete($this->_expenseReportUri, $id);
    }

}
