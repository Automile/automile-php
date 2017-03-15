<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle Defect Model
 * 
 * @method int getVehicleInspectionId()
 * @method int getVehicleId()
 * @method int getCreatedByContactId()
 * @method int getInspectionStatusType()
 * @method \DateTime getInspectionDateUtc()
 * @method DefectRowset getVehicleDefects()
 * @method InspectionStatusRowset getInspectionStatus()
 * 
 * @method Inspection setVehicleInspectionId(int $inspectionId)
 * @method Inspection setVehicleId(int $vehicleId)
 * @method Inspection setCreatedByContactId(int $contactId)
 * @method Inspection setInspectionStatusType(int $statusType)
 */
class Inspection extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleInspectionId',
		'VehicleId',
		'CreatedByContactId',
		'InspectionStatusType',
		'InspectionDateUtc',
		'VehicleDefects',
		'InspectionStatus'
    ];

    /**
     * @param array|object $defects
     * @return Inspection
     */
    public function setVehicleDefects($defects)
    {
        if (!is_object($defects) || !$defects instanceof DefectRowset) {
            $defects = new DefectRowset($defects);
        }

        $this->_properties['VehicleDefects'] = $defects;
        return $this;
    }

    /**
     * @param array|object $status
     * @return Inspection
     */
    public function setInspectionStatus($status)
    {
        if (!is_object($status) || !$status instanceof InspectionStatusRowset) {
            $status = new InspectionStatusRowset($status);
        }

        $this->_properties['InspectionStatus'] = $status;
        return $this;
    }

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return Inspection
     */
    public function setInspectionDateUtc ($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['InspectionDateUtc'] = $dateTime;

        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['InspectionDateUtc'])) {
            $values['InspectionDateUtc'] = $values['InspectionDateUtc']->format('c');
        }

        return $values;
    }

}
