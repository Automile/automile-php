<?php

namespace Automile\Sdk\Models;

/**
 * DeviceEvent Model
 *
 * @method int getIMEIEventId()
 * @method string getIMEI()
 * @method string getEventType()
 * @method string getTimeStamp()
 *
 * @method DeviceEvent setIMEIEventId(int $eventId)
 * @method DeviceEvent setIMEI(string $imei)
 * @method DeviceEvent setEventType(string $eventType)
 * @method DeviceEvent setTimeStamp(string $timeStamp)
 */
class DeviceEvent extends ModelAbstract
{

    protected $_allowedProperties = [
        "IMEIEventId",
        "IMEI",
        "EventType",
        "TimeStamp"
    ];

}
