<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Types\PublishSubscribeAuthenticationType;
use Automile\Sdk\Types\PublishType;

/**
 * PublishSubscribe Model
 *
 * @see PublishSubscribeAuthenticationType
 * @see PublishType
 *
 * @method int getPublishSubscribeId()
 * @method string getPublishToUrl()
 * @method int getPublishType()
 * @method int getVehicleId()
 * @method int getAuthenticationType()
 * @method string getAuthenticationData()
 *
 * @method int setPublishSubscribeId(int $subscribeId)
 * @method string setPublishToUrl(string $url)
 * @method int setPublishType(int $publishType)
 * @method int setVehicleId(int $vehicleId)
 * @method int setAuthenticationType(int $authenticationType)
 * @method string setAuthenticationData(string $data)
 */
class PublishSubscribe extends ModelAbstract
{

    protected $_allowedProperties = [
        "PublishSubscribeId",
        "PublishToUrl",
        "PublishType",
        "VehicleId",
        "AuthenticationType",
        "AuthenticationData"
    ];

}
