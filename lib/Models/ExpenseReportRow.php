<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportRow Model
 *
 * @method int getExpenseReportRowId() (integer, optional),
 * @method int getExpenseReportId()
 * @method float getAmountInCurrency()
 * @method float getVATInCurrency()
 * @method string getISO4217CurrencyCode()
 * @method string getNotes()
 * @method string getExpenseReportRowDateUtc()
 * @method ExpenseReportRowContentRowset getExpenseReportRowContent()
 * @method int getCategory()
 * @method string getCustomCategory()
 * @method float getCategoryValue()
 * @method string getMerchant()
 *
 * @method ExpenseReportRow setExpenseReportRowId(int $expenseReportRowId)
 * @method ExpenseReportRow setExpenseReportId(int $expenseReportId)
 * @method ExpenseReportRow setAmountInCurrency(float $amount)
 * @method ExpenseReportRow setVATInCurrency(float $vat)
 * @method ExpenseReportRow setISO4217CurrencyCode(string $code)
 * @method ExpenseReportRow setNotes(string $notes)
 * @method ExpenseReportRow setExpenseReportRowDateUtc(string $date)
 * @method ExpenseReportRow setCategory(int $category)
 * @method ExpenseReportRow setCustomCategory(string $customCategory)
 * @method ExpenseReportRow setCategoryValue(float $value)
 * @method ExpenseReportRow setMerchant(string $merchant)
 */
class ExpenseReportRow extends ModelAbstract
{

    protected $_allowedProperties = [
        "ExpenseReportRowId",
        "ExpenseReportId",
        "AmountInCurrency",
        "VATInCurrency",
        "ISO4217CurrencyCode",
        "Notes",
        "ExpenseReportRowDateUtc",
        "ExpenseReportRowContent",
        "Category",
        "CustomCategory",
        "CategoryValue",
        "Merchant"
    ];

    /**
     * @param array|object $rows
     * @return ExpenseReportRow
     */
    public function setExpenseReportRowContent($rows)
    {
        if (!is_object($rows) || !$rows instanceof ExpenseReportRowContentRowset) {
            $rows = new ExpenseReportRowContentRowset($rows);
        }

        $this->_properties['ExpenseReportRowContent'] = $rows;
        return $this;
    }

}
