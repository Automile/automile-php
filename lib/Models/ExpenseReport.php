<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReport Model
 *
 * @method int getExpenseReportId()
 * @method int getContactId()
 * @method int getVehicleId()
 * @method int getTripId()
 * @method string getExpenseReportDateUtc()
 * @method ExpenseReportRowRowset getExpenseReportRows()
 *
 * @method ExpenseReport setExpenseReportId(int $expenseReportId)
 * @method ExpenseReport setContactId(int $contactId)
 * @method ExpenseReport setVehicleId(int $vehicleId)
 * @method ExpenseReport setTripId(int $tripId)
 * @method ExpenseReport setExpenseReportDateUtc(string $date)
 */
class ExpenseReport extends ModelAbstract
{

    protected $_allowedProperties = [
        'ExpenseReportId',
        'ContactId',
        'VehicleId',
        'TripId',
        'ExpenseReportDateUtc',
        'ExpenseReportRows'
    ];

    /**
     * @param array|object $rows
     * @return ExpenseReport
     */
    public function setExpenseReportRows($rows)
    {
        if (!is_object($rows) || !$rows instanceof ExpenseReportRowRowset) {
            $rows = new ExpenseReportRowRowset($rows);
        }

        $this->_properties['ExpenseReportRows'] = $rows;
        return $this;
    }

}
