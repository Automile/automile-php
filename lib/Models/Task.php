<?php

namespace Automile\Sdk\Models;

/**
 * Task Model
 *
 * @method Task setTaskId(int $taskId)
 * @method int getTaskId()
 */
class Task extends ModelAbstract
{

    protected $_allowedProperties = [
        "TaskId",
        "CreatedByContactId",
        "CreatedByContactName",
        "TaskAcquiredByContactId",
        "TaskAcquiredByContactName",
        "LastMessageSentByContactId",
        "LastMessageSentByContactName",
        "LastMessageShortText",
        "LastMessageDateUtc",
        "LastMessageIsRead",
        "CreatedByContactImageUrl",
        "TaskAcquiredByContactImageUrl",
        "TaskStatusType",
        "TaskType",
        "UnreadTaskMessages",
        "TaskMessages",
        "Position",
        "ToContactId"
    ];

    /**
     * @param array|object $rows
     * @return Task
     */
    public function setTaskMessages($rows)
    {
        if (!is_object($rows) || !$rows instanceof TaskMessageRowset) {
            $rows = new TaskMessageRowset($rows);
        }

        $this->_properties['TaskMessages'] = $rows;
        return $this;
    }

    /**
     * @param array|object $position
     * @return Task
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
