<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle DefectStatus Model
 * 
 * @method int getVehicleDefectStatusId()
 * @method int getVehicleDefectId()
 * @method int getCreatedByContactId()
 * @method int getDefectStatus()
 * @method string getDefectStatusDateUtc()
 * 
 * @method DefectStatus setVehicleDefectStatusId(int $statusId)
 * @method DefectStatus setVehicleDefectId(int $defectId)
 * @method DefectStatus setCreatedByContactId(int $contactId)
 * @method DefectStatus setDefectStatus(int $comment)
 * @method DefectStatus setDefectStatusDateUtc(string $date)
 */
class DefectStatus extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleDefectStatusId',
		'VehicleDefectId',
		'CreatedByContactId',
		'DefectStatus',
		'DefectStatusDateUtc'
    ];

}
