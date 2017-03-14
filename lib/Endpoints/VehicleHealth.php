<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Models\Vehicle\Health as VehicleHealthModel;

/**
 * VehicleHealth API Queries
 */
trait VehicleHealth
{

    protected $_vehicleHealthUri = '/v1/resourceowner/vehiclehealth';

    /**
     * Get health indicators for a vehicle over a period of time
     * @param int $vehicleId
     * @param string $datePeriod optional
     * @return VehicleHealthModel
     * @throws AutomileException
     */
    public function getVehicleHealthByVehicleId($vehicleId, $datePeriod = null)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $vehicleId = (int)$vehicleId;
        $params = $datePeriod ? "{$datePeriod}/{$vehicleId}" : $vehicleId;

        $request->setMethod(Config::METHOD_GET)
            ->setUri($this->_vehicleHealthUri . '/' . $params);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleHealthModel($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

}
