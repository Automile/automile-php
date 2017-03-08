<?php

namespace Automile\Sdk\Models;

/**
 * ExpenseReportsEmail Model
 *
 * @method int getVehicleId()
 * @method \DateTime getFromDate()
 * @method \DateTime getToDate()
 * @method string getToEmail()
 * @method string getISO639LanguageCode()
 *
 * @method ExpenseReportsEmail setVehicleId()
 * @method ExpenseReportsEmail setToEmail()
 * @method ExpenseReportsEmail setISO639LanguageCode()
 */
class ExpenseReportsEmail extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleId',
        'FromDate',
        'ToDate',
        'ToEmail',
        'ISO639LanguageCode'
    ];

    /**
     * @param \DateTime $date
     * @return ExpenseReportsEmail
     */
    public function setFromDate(\DateTime $date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }
        $this->_properties['FromDate'] = $date;

        return $this;
    }

    /**
     * @param \DateTime $date
     * @return ExpenseReportsEmail
     */
    public function setToDate(\DateTime $date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }
        $this->_properties['ToDate'] = $date;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['FromDate'])) {
            $values['FromDate'] = $values['FromDate']->format('c');
        }

        if (!empty($values['ToDate'])) {
            $values['ToDate'] = $values['ToDate']->format('c');
        }

        return $values;
    }

}
