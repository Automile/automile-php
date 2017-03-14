<?php

namespace Automile\Sdk\Endpoints;

use Automile\Sdk\Exceptions\AutomileException;
use Automile\Sdk\Config;
use Automile\Sdk\Exceptions\InvalidArgumentException;
use Automile\Sdk\Models\Report\TripEmail;
use Automile\Sdk\Models\Report\TripSummaryRowset;
use Automile\Sdk\Models\Report\VehicleSummary;
use Automile\Sdk\Types\DatePeriod;

/**
 * Report API Queries
 */
trait Report
{

    private $_reportUri = '/v1/resourceowner/reports';

    /**
     * Get a trip summary report
     *
     * @param string $datePeriod acceptable formats: yyyy[mm], yyyy[mm]-yyyy[mm]
     * @param int $vehicleId optional
     * @return TripSummaryRowset
     * @throws InvalidArgumentException
     *
     * @see DatePeriod
     */
    public function getTripSummaryReport($datePeriod, $vehicleId = null)
    {
        if (!DatePeriod::isValid($datePeriod)) {
            throw new InvalidArgumentException("Incorrect date period: '{$datePeriod}'");
        }

        if ($vehicleId && (string)(int)$vehicleId !== (string)$vehicleId) {
            throw new InvalidArgumentException("Incorrect VehicleId value: '{$vehicleId}'");
        }

        $uri = $this->_reportUri . '/tripsummary/' . $datePeriod;

        if ((int)$vehicleId) {
            $uri .= '/' . $vehicleId;
        }

        return $this->_getAll($uri, new TripSummaryRowset());
    }

    /**
     * Get a vehicle summary report
     *
     * @param string $datePeriod acceptable formats: yyyy[mm], yyyy[mm]-yyyy[mm]
     * @param int $vehicleId
     * @return mixed
     * @throws InvalidArgumentException
     * @throws AutomileException
     *
     * @see DatePeriod
     */
    public function getVehiclesSummaryReport($datePeriod, $vehicleId = null)
    {
        if (!DatePeriod::isValid($datePeriod)) {
            throw new InvalidArgumentException("Incorrect date period: '{$datePeriod}'");
        }

        if ($vehicleId && (string)(int)$vehicleId !== (string)$vehicleId) {
            throw new InvalidArgumentException("Incorrect VehicleId value: '{$vehicleId}'");
        }

        $uri = $this->_reportUri . '/vehiclesummary/' . $datePeriod;

        if ((int)$vehicleId) {
            $uri .= '/' . $vehicleId;
        }

        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_GET)
            ->setUri($uri);

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return new VehicleSummary($response->getBody());
        }

        throw new AutomileException($response->getErrorMessage());
    }

    /**
     * Email a trip journal report to a desired email address
     *
     * @param TripEmail $model
     * @throws AutomileException
     * @return bool
     */
    public function emailTripReport(TripEmail $model)
    {
        $request = Config::getNewRequest();
        $response = Config::getNewResponse();
        $client = Config::getNewHttpClient();

        $this->_authorizeRequest($request);

        $request->setMethod(Config::METHOD_POST)
            ->setUri($this->_reportUri . '/emailtripreport')
            ->setBody($model->toJson())
            ->setContentType('application/json');

        $isSuccessful = $client->send($request, $response);

        if ($isSuccessful) {
            return true;
        }

        $errorMessage = $response->getErrorMessage();
        throw new AutomileException($errorMessage ?: "Error code: {$response->getStatusCode()}");
    }

}
