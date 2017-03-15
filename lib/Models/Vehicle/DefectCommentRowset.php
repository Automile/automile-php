<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelRowsetAbstract;

/**
 * Vehicle DefectComment Rowset Model
 */
class DefectCommentRowset extends ModelRowsetAbstract
{

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return DefectComment
     */
    public function getModel($properties)
    {
        return new DefectComment($properties);
    }

}
