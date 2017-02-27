<?php

namespace Automile\Sdk\Models;

/**
 * TriggerMessageHistory Model
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
