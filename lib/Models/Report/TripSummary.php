<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelAbstract;

/**
 * TripSummary Report Model
 *
 * @see \Automile\Sdk\Types\TripType
 *
 * @method int getReportStartPeriod()
 * @method int getReportEndPeriod()
 * @method int getVehicleId()
 * @method int getTripType()
 * @method float getDistanceInKilometers()
 * @method int getTravelTimeInMinutes()
 * @method float getFuelInLiters()
 *
 * @method TripSummary setReportStartPeriod(int $startDate)
 * @method TripSummary setReportEndPeriod(int $endDate)
 * @method TripSummary setVehicleId(int $vehicleId)
 * @method TripSummary setTripType(int $tripType)
 * @method TripSummary setDistanceInKilometers(float $distance)
 * @method TripSummary setTravelTimeInMinutes(int $minutes)
 * @method TripSummary setFuelInLiters(float $liters)
 */
class TripSummary extends ModelAbstract
{

    protected $_allowedProperties = [
        "ReportStartPeriod",
        "ReportEndPeriod",
        "VehicleId",
        "TripType",
        "DistanceInKilometers",
        "TravelTimeInMinutes",
        "FuelInLiters"
    ];

}
