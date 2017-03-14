<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle InspectionStatus Model
 * 
 * @method int getVehicleInspectionStatusId()
 * @method int getVehicleInspectionId()
 * @method int getCreatedByContactId()
 * @method int getInspectionStatusType()
 * @method \DateTime getStatusDateUtc()
 * 
 * @method DefectStatus setVehicleInspectionStatusId(int $statusId)
 * @method DefectStatus setVehicleInspectionId(int $inspectionId)
 * @method DefectStatus setCreatedByContactId(int $contactId)
 * @method DefectStatus setInspectionStatusType(int $statusType)
 */
class InspectionStatus extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleInspectionStatusId',
		'VehicleInspectionId',
		'CreatedByContactId',
		'InspectionStatusType',
		'StatusDateUtc'
    ];

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return Defect
     */
    public function setStatusDateUtc($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['StatusDateUtc'] = $dateTime;

        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['StatusDateUtc'])) {
            $values['StatusDateUtc'] = $values['StatusDateUtc']->format('c');
        }

        return $values;
    }

}
