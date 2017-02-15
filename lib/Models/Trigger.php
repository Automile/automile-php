<?php

namespace Automile\Sdk\Models;

/**
 * Trigger Model
 * @package Automile\Sdk\Models
 * @method int getTriggerId()
 */
class Trigger extends ModelAbstract
{

    protected $_allowedProperties = [
        "TriggerId",
        "IMEIConfigId",
        "TriggerType",
        "TriggerTypeData",
        "ValidFrom",
        "ValidTo",
        "MutedUntilDateTime",
        "MutedForAdditionalSeconds",
        "DestinationType",
        "DestinationData",
        "DeliveryType",
        "APIClientId",
        "CreatedAt",
        "TriggerTypeData2"
    ];

}
