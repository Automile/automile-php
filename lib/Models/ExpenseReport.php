<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReport Model
 *
 * @method int getExpenseReportId()
 * @method int getContactId()
 * @method int getVehicleId()
 * @method int getTripId()
 * @method ExpenseReportRowRowset getExpenseReportRows()
 *
 * @method ExpenseReport setExpenseReportId(int $expenseReportId)
 * @method ExpenseReport setContactId(int $contactId)
 * @method ExpenseReport setVehicleId(int $vehicleId)
 * @method ExpenseReport setTripId(int $tripId)
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

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return ExpenseReport
     */
    public function setExpenseReportDateUtc ($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['ExpenseReportDateUtc'] = $dateTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpenseReportDateUtc()
    {
        return empty($this->_properties['ExpenseReportDateUtc']) ? null : $this->_properties['ExpenseReportDateUtc'];
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['ExpenseReportDateUtc'])) {
            $values['ExpenseReportDateUtc'] = $values['ExpenseReportDateUtc']->format('c');
        }

        return $values;
    }

}
