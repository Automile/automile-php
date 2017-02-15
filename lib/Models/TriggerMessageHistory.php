<?php

namespace Automile\Sdk\Models;

/**
 * TriggerMessageHistory Model
 * @package Automile\Sdk\Models
 */
class TriggerMessageHistory extends ModelAbstract
{

    protected $_allowedProperties = [
        "TriggerMessageHistoryId",
        "TriggerId",
        "WasSentOn",
        "DestinationType",
        "DestinationData",
        "MessageData1",
        "MessageData2"
    ];

}
