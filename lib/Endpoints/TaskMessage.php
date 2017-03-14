<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\TaskMessage as TaskMessageModel;

/**
 * TaskMessage API Queries
 */
trait TaskMessage
{

    private $_taskMessageUri = '/v1/resourceowner/taskmessage';

    /**
     * Get a task message
     * @param int $taskMessageId
     * @return TaskMessageModel
     */
    public function getByTaskMessageId($taskMessageId)
    {
        return $this->_getById($this->_taskMessageUri, $taskMessageId, new TaskMessageModel());
    }

    /**
     * Create a task message
     * @param TaskMessageModel $taskMessage
     * @return TaskMessageModel
     */
    public function createTaskMessage(TaskMessageModel $taskMessage)
    {
        return $this->_create($this->_taskMessageUri, $taskMessage);
    }

    /**
     * Mark a task message as read/unread
     * @param int $taskMessageId
     * @param bool $isRead true to mark as read, false to mark as unread
     * @return bool
     * @throws AutomileException
     */
    public function markReadTaskMessage($taskMessageId, $isRead)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_taskMessageUri . '/' . (int)$taskMessageId)
            ->setBody(json_encode(['isRead' => (bool)$isRead]))
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
