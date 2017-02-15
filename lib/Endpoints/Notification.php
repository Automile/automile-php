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
     * @throws AutomileException
     */
    public function getNotifications()
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_notificationUri);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new TriggerRowset($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Get a trigger by id
     * @param int $notificationId
     * @return Trigger
     * @throws AutomileException
     */
    public function getNotificationById($notificationId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_notificationUri . '/' . (int)$notificationId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new Trigger($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Creates a new trigger
     * @param Trigger $notification
     * @return Trigger
     * @throws AutomileException
     */
    public function createNotification(Trigger $notification)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_notificationUri)
            ->setBody($notification->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            $notification->reset($response->getBody());
            return $notification;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

    /**
     * Deletes the notification
     * @param $notificationId
     * @return bool
     * @throws AutomileException
     */
    public function deleteNotification($notificationId)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_DELETE)
            ->setUri($this->_notificationUri . '/' . (int)$notificationId);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
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

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_PUT)
            ->setUri($this->_notificationUri . '/' . (int)$notification->getTriggerId())
            ->setBody($notification->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return $notification;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
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
