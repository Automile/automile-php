<?php

namespace Automile\Sdk\Endpoints;
use Automile\Sdk\AutomileException;
use Automile\Sdk\Models\PublishSubscribeAuthentication\AuthenticationAbstract;
use Automile\Sdk\Models\PublishSubscribeRowset;
use Automile\Sdk\Models\PublishSubscribe as PublishSubscribeModel;
use Automile\Sdk\Types\PublishSubscribeAuthenticationType;
use Automile\Sdk\Types\PublishType;

/**
 * PublishSubscribe API Queries
 * @package Automile\Sdk\Endpoints
 */
trait PublishSubscribe
{

    private $_publishSubscribeUri = '/v1/resourceowner/publishsubscribe';

    /**
     * Get all publish subscribe records the user has created
     * @return PublishSubscribeRowset
     */
    public function getPublishSubscribe()
    {
        return $this->_getAll($this->_publishSubscribeUri, new PublishSubscribeRowset());
    }

    /**
     * Get the publish subscribe by record id
     * @param int $id
     * @return PublishSubscribeModel
     */
    public function getPublishSubscribeById($id)
    {
        return $this->_getById($this->_publishSubscribeUri, $id, new PublishSubscribeModel());
    }

    /**
     * Create a publish subscribe record
     * @param string|PublishSubscribeModel $urlOrModel PublishToUrl value or an instance of PublishSubscribe model
     * @param AuthenticationAbstract|int $tokenOrVehicleId Optional authentication token object or vehicleID
     * @param int $vehicleId Optional if you want only to subscribe to a specific vehicle
     * @return PublishSubscribeModel
     *
     * @example PublishSubscribeModel createPublishSubscribe(string $url, int $vehicleId = null)
     * @example PublishSubscribeModel createPublishSubscribe(string $url, AuthenticationAbstract $token, int $vehicleId = null)
     * @example PublishSubscribeModel createPublishSubscribe(PublishSubscribeModel $model)
     */
    public function createPublishSubscribe($urlOrModel, $tokenOrVehicleId = null, $vehicleId = null)
    {
        if ($urlOrModel instanceof PublishSubscribeModel) {
            return $this->_create($this->_publishSubscribeUri, $urlOrModel);
        }

        $model = new PublishSubscribeModel([
            'PublishToUrl' => $urlOrModel,
            'PublishType' => PublishType::JSON_DEFAULT
        ]);

        if ($tokenOrVehicleId instanceof AuthenticationAbstract) {
            $model->setAuthenticationType($tokenOrVehicleId->getAuthenticationType());
            $model->setAuthenticationData($tokenOrVehicleId->toJson());
        } else {
            $model->setAuthenticationType(PublishSubscribeAuthenticationType::NONE_ANONYMOUS);
            $vehicleId = (int)$tokenOrVehicleId;
        }

        if ($vehicleId) {
            $model->setVehicleId((int)$vehicleId);
        }

        return $this->createPublishSubscribe($model);
    }

    /**
     * Edit a publish subscribe record
     * @param int $publishSubscribeId
     * @param string|PublishSubscribeModel $urlOrModel PublishToUrl value or an instance of PublishSubscribe model
     * @param AuthenticationAbstract|int $tokenOrVehicleId Optional authentication token object or vehicleID
     * @param int $vehicleId Optional if you want only to subscribe to a specific vehicle
     * @return PublishSubscribeModel
     *
     * @example PublishSubscribeModel editPublishSubscribe(int $publishSubscribeId, string $url, int $vehicleId = null)
     * @example PublishSubscribeModel editPublishSubscribe(int $publishSubscribeId, string $url, AuthenticationAbstract $token, int $vehicleId = null)
     * @example PublishSubscribeModel editPublishSubscribe(int $publishSubscribeId, PublishSubscribeModel $model)
     */
    public function editPublishSubscribe($publishSubscribeId, $urlOrModel, $tokenOrVehicleId = null, $vehicleId = null)
    {
        if (!(int)$publishSubscribeId) {
            throw new AutomileException("PublishSubscribe ID is missing");
        }

        if ($urlOrModel instanceof PublishSubscribeModel) {
            return $this->_edit($this->_publishSubscribeUri, $publishSubscribeId, $urlOrModel);
        }

        $model = new PublishSubscribeModel([
            'PublishSubscribeId' => $publishSubscribeId,
            'PublishToUrl' => $urlOrModel,
            'PublishType' => PublishType::JSON_DEFAULT
        ]);

        if ($tokenOrVehicleId instanceof AuthenticationAbstract) {
            $model->setAuthenticationType($tokenOrVehicleId->getAuthenticationType());
            $model->setAuthenticationData($tokenOrVehicleId->toJson());
        } else {
            $model->setAuthenticationType(PublishSubscribeAuthenticationType::NONE_ANONYMOUS);
            $vehicleId = (int)$tokenOrVehicleId;
        }

        if ($vehicleId) {
            $model->setVehicleId((int)$vehicleId);
        }

        return $this->editPublishSubscribe($publishSubscribeId, $model);
    }

    /**
     * Removes the given publish subscribe record
     * @param int $publishSubscribeId
     * @return bool
     */
    public function deletePublishSubscribe($publishSubscribeId)
    {
        return $this->_delete($this->_publishSubscribeUri, $publishSubscribeId);
    }

}
