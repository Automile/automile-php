<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle DefectComment Model
 * 
 * @method int getVehicleDefectCommentId()
 * @method int getVehicleDefectId()
 * @method int getCreatedByContactId()
 * @method string getComment()
 * @method string getCommentDateUtc()
 * 
 * @method DefectComment setVehicleDefectCommentId(int $commentId)
 * @method DefectComment setVehicleDefectId(int $defectId)
 * @method DefectComment setCreatedByContactId(int $contactId)
 * @method DefectComment setComment(string $comment)
 * @method DefectComment setCommentDateUtc(string $date)
 */
class DefectComment extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleDefectCommentId',
		'VehicleDefectId',
		'CreatedByContactId',
		'Comment',
		'CommentDateUtc'
    ];

}
