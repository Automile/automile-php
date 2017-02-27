<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Models\TaskRowset;
use Automile\Sdk\Models\Task as TaskModel;

/**
 * Task API Queries
 */
trait Task
{

    private $_taskUri = '/v1/resourceowner/task';

    /**
     * Get all tasks open and closed
     * @return TaskRowset
     */
    public function getTasks()
    {
        return $this->_getAll($this->_taskUri, new TaskRowset());
    }

    /**
     * Get task details
     * @param $taskId
     * @return TaskModel
     */
    public function getByTaskId($taskId)
    {
        return $this->_getById($this->_taskUri, $taskId, new TaskModel());
    }

    /**
     * Create a task
     * @param TaskModel $task
     * @return TaskModel
     */
    public function createTask(TaskModel $task)
    {
        return $this->_create($this->_taskUri, $task);
    }

    /**
     * Update a task
     * @param TaskModel $task
     * @return TaskModel
     * @throws AutomileException
     */
    public function editTask(TaskModel $task)
    {
        if (!$task->getTaskId()) {
            throw new AutomileException("Task ID is missing");
        }

        return $this->_edit($this->_taskUri, $task->getTaskId(), $task);
    }

}
