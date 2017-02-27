<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Types\ContentType;

/**
 * ExpenseReportRowContent Model
 *
 * @see ContentType
 *
 * @method int getExpenseReportRowContentId()
 * @method int getExpenseReportRowId()
 * @method int getContentType()
 * @method string getContentFileName()
 *
 * @method ExpenseReportRowContent setExpenseReportRowContentId(int $expenseReportRowContentId)
 * @method ExpenseReportRowContent setExpenseReportRowId(int $expenseReportRowId)
 * @method ExpenseReportRowContent setContentType(int $contentType)
 * @method ExpenseReportRowContent setContentFileName(string $filename)
 */
class ExpenseReportRowContent extends ModelAbstract
{

    protected $_allowedProperties = [
        "ExpenseReportRowContentId",
        "ExpenseReportRowId",
        "ContentType",
        "ContentFileName"
    ];

}
