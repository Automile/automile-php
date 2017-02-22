<?php

namespace Automile\Sdk\Models;

/**
 * TaskMessage Model
 * @package Automile\Sdk\Models
 */
class TaskMessage extends ModelAbstract
{
    
    protected $_allowedProperties = [
        "TaskMessageId",
        "SentByContactId",
        "ToContactId",
        "MessageText",
        "MessageSentAtUtc",
        "SentByContactName",
        "ToContactName",
        "MessageIsRead",
        "Position"
    ];

    /**
     * @param array|object $position
     * @return GeographicPosition
     */
    public function setPosition($position)
    {
        if (!is_object($position) || !$position instanceof GeographicPosition) {
            $position = new GeographicPosition($position);
        }

        $this->_properties['Position'] = $position;
        return $this;
    }

}
