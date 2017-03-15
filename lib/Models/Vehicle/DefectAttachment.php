<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;
use Automile\Sdk\Models\ModelException;
use Automile\Sdk\Types\AttachmentType;

/**
 * Vehicle DefectAttachment Model
 * 
 * @method int getVehicleDefectAttachmentId()
 * @method int getVehicleDefectId()
 * @method string getAttachmentType()
 * @method string getAttachmentLocation()
 * @method string getAttachmentDateUtc()
 * @method string getData() base64-encoded raw data upon uploading
 * @method string getDataFile() path to the attachment file upon uploading
 * 
 * @method DefectAttachment setVehicleDefectAttachmentId(int $attachmentId)
 * @method DefectAttachment setVehicleDefectId(int $defectId)
 * @method DefectAttachment setAttachmentType(string $type)
 * @method DefectAttachment setAttachmentLocation(string $location)
 * @method DefectAttachment setAttachmentDateUtc(string $date)
 * @method DefectAttachment setData(string $data) base64-encoded raw data upon uploading
 * @method DefectAttachment setDataFile(string $dataFile) path to the attachment file upon uploading
 */
class DefectAttachment extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleDefectAttachmentId',
		'VehicleDefectId',
		'AttachmentType',
		'AttachmentLocation',
		'AttachmentDateUtc',
        'Data',
        'DataFile'
    ];

    /**
     * @return array
     * @throws ModelException
     */
    public function toArray()
    {
        $data = parent::toArray();

        if (!empty($data['DataFile'])) {
            if (!empty($data['Data'])) {
                throw new ModelException('Content data already exists');
            }

            $content = @file_get_contents($data['DataFile']);
            if (!$content) {
                throw new ModelException("Data File is empty or inaccessible: '{$data['DataFile']}");
            }

            $data['Data'] = base64_encode($content);

            if (!isset($data['AttachmentType'])) {
                $data['AttachmentType'] = AttachmentType::getByFilename($data['DataFile']);
            }

            unset($data['DataFile']);
        }

        return $data;
    }

}
