<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Trigger;
use Automile\Sdk\Models\TriggerMute;
use Automile\Sdk\Models\TriggerRowset;

/**
 * Notification (Trigger) API Queries
 * @package Automile\Sdk\Endpoints
 */
trait Notification
{

    private $_notificationUri = '/v1/resourceowner/triggers';

    /**
     * Get all triggers
     * @return TriggerRowset
     */
    public function getNotifications()
    {
        return $this->_getAll($this->_notificationUri, new TriggerRowset());
    }

    /**
     * Get a trigger by id
     * @param int $notificationId
     * @return Trigger
     * @throws AutomileException
     */
    public function getNotificationById($notificationId)
    {
        return $this->_getById($this->_notificationUri, $notificationId, new Trigger());
    }

    /**
     * Creates a new trigger
     * @param Trigger $notification
     * @return Trigger
     */
    public function createNotification(Trigger $notification)
    {
        return $this->_create($this->_notificationUri, $notification);
    }

    /**
     * Deletes the notification
     * @param $notificationId
     * @return bool
     */
    public function deleteNotification($notificationId)
    {
        return $this->_delete($this->_notificationUri, $notificationId);
    }

    /**
     * Edit notification
     * @param Trigger $notification
     * @return Trigger
     * @throws AutomileException
     */
    public function editNotification(Trigger $notification)
    {
        if (!$notification->getTriggerId()) {
            throw new AutomileException('Notification ID is empty');
        }

        return $this->_edit($this->_notificationUri, $notification->getTriggerId(), $notification);
    }

    /**
     * Mutes a notification
     * @param int $notificationId
     * @param int $secondsFromNow
     * @return bool
     * @throws AutomileException
     */
    public function muteNotification($notificationId, $secondsFromNow)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $mute = new TriggerMute(['SecondsFromNow' => $secondsFromNow]);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_notificationUri . '/mute/' . (int)$notificationId)
            ->setBody($mute->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Unmutes a notification
     * @param int $notificationId
     * @return bool
     * @throws AutomileException
     */
    public function unmuteNotification($notificationId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_notificationUri . '/unmute/' . (int)$notificationId)
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
