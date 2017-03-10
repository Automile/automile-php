<?php

namespace Automile\Sdk\Models;

/**
 * TaskMessage Model
 *
 * @method int getTaskMessageId()
 * @method int getSendByContactId()
 * @method int getToContactId()
 * @method string getMessageText()
 * @method \DateTime getMessageSentAtUtc()
 * @method string getSentByContactName()
 * @method string getToContactName()
 * @method bool getMessageIsRead()
 * @method GeographicPosition getPosition()
 * @method int getTaskId()
 *
 * @method TaskMessage setTaskMessageId(int $taskMessageId)
 * @method TaskMessage setSendByContactId(int $contactId)
 * @method TaskMessage setToContactId(int $contactId)
 * @method TaskMessage setMessageText(string $messageText)
 * @method TaskMessage setSentByContactName(strinng $contactName)
 * @method TaskMessage setToContactName(string $contactName)
 * @method TaskMessage setMessageIsRead(bool $isRead)
 * @method TaskMessage setTaskId(int $taskId)
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
        "Position",
        "TaskId"
    ];

    /**
     * @param array|object $position
     * @return TaskMessage
     */
    public function setPosition($position)
    {
        if (!is_object($position) || !$position instanceof GeographicPosition) {
            $position = new GeographicPosition($position);
        }

        $this->_properties['Position'] = $position;
        return $this;
    }

    /**
     * @param string|\DateTime $dateTime a DateTime object or date in string representation
     * @return TaskMessage
     */
    public function setMessageSentAtUtc ($dateTime)
    {
        if (!$dateTime instanceof \DateTime) {
            $dateTime = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        }
        $this->_properties['MessageSentAtUtc'] = $dateTime;

        return $this;
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = parent::toArray();

        if (!empty($values['MessageSentAtUtc'])) {
            $values['MessageSentAtUtc'] = $values['MessageSentAtUtc']->format('c');
        }

        return $values;
    }

}
