<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle DefectAttachment Model
 * 
 * @method int getVehicleDefectAttachmentId()
 * @method int getVehicleDefectId()
 * @method string getAttachmentType()
 * @method string getAttachmentLocation()
 * @method string getAttachmentDateUtc()
 * 
 * @method DefectAttachment setVehicleDefectAttachmentId(int $attachmentId)
 * @method DefectAttachment setVehicleDefectId(int $defectId)
 * @method DefectAttachment setAttachmentType(string $type)
 * @method DefectAttachment setAttachmentLocation(string $location)
 * @method DefectAttachment setAttachmentDateUtc(string $date)
 */
class DefectAttachment extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleDefectAttachmentId',
		'VehicleDefectId',
		'AttachmentType',
		'AttachmentLocation',
		'AttachmentDateUtc'
    ];

}
