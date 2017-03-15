<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle Defect Model
 * 
 * @method int getVehicleDefectId()
 * @method int getVehicleInspectionId()
 * @method int getDefectType()
 * @method int getCreatedByContactId()
 * @method \DateTime getDefectDateUtc()
 * @method string getNotes()
 * @method int getDefectStatusType()
 * @method DefectStatusRowset getVehicleDefectStatus()
 * @method DefectAttachmentRowset getVehicleDefectAttachments()
 * @method DefectCommentRowset getVehicleDefectComments()
 * 
 * @method Defect setVehicleDefectId(int $defectId)
 * @method Defect setVehicleInspectionId(int $inspectionId)
 * @method Defect setDefectType(int $type)
 * @method Defect setCreatedByContactId(int $contactId)
 * @method Defect setNotes(string $notes)
 * @method Defect setDefectStatusType(int $statusType)
 */
class Defect extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleDefectId',
		'VehicleInspectionId',
		'DefectType',
		'CreatedByContactId',
		'DefectDateUtc',
		'Notes',
		'DefectStatusType',
		'VehicleDefectStatus',
		'VehicleDefectAttachments',
		'VehicleDefectComments'
    ];

    /**
     * @param array|object $status
     * @return Defect
     */
    public function setVehicleDefectStatus($status)
    {
        if (!is_object($status) || !$status instanceof DefectStatusRowset) {
            $status = new DefectStatusRowset($status);
        }

        $this->_properties['VehicleDefectStatus'] = $status;
        return $this;
    }

    /**
     * @param array|object $comments
     * @return Defect
     */
    public function setVehicleDefectComments($comments)
    {
        if (!is_object($comments) || !$comments instanceof DefectCommentRowset) {
            $comments = new DefectCommentRowset($comments);
        }

        $this->_properties['VehicleDefectComments'] = $comments;
        return $this;
    }

    /**
     * @param array|object $attachments
     * @return Defect
     */
    public function setVehicleDefectAttachments($attachments)
    {
        if (!is_object($attachments) || !$attachments instanceof DefectAttachmentRowset) {
            $attachments = new DefectAttachmentRowset($attachments);
        }

        $this->_properties['VehicleDefectAttachments'] = $attachments;
        return $this;
    }

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return Defect
     */
    public function setDefectDateUtc($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['DefectDateUtc'] = $dateTime;

        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['DefectDateUtc'])) {
            $values['DefectDateUtc'] = $values['DefectDateUtc']->format('c');
        }

        return $values;
    }

}
