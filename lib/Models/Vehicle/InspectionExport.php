<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * InspectionExport Vehicle Model
 */
class InspectionExport extends ModelAbstract
{

    protected $_allowedProperties = [
        'ToEmail',
        'ISO639LanguageCode'
    ];

}
