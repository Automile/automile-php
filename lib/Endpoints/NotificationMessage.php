<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\TriggerMessageHistoryRowset;

/**
 * NotificationMessages API Queries
 * @package Automile\Sdk\Endpoints
 */
trait NotificationMessage
{

    protected $_notificationMessagesUri = '/v1/resourceowner/triggermessageshistory';

    /**
     * Get all trigger messages that the logged in user has access to
     * @return TriggerMessageHistoryRowset
     */
    public function getNotificationMessages()
    {
        return $this->_getAll($this->_notificationMessagesUri, new TriggerMessageHistoryRowset());
    }

    public function getNotificationMessagesByNotificationId($notificationId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_notificationMessagesUri . '/' . (int)$notificationId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TriggerMessageHistoryRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
