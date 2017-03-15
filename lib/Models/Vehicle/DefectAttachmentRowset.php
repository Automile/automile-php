<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle DefectAttachment Rowset Model
 */
class DefectAttachmentRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DefectAttachment
     */
    public function getModel($properties)
    {
        return new DefectAttachment($properties);
    }

}
