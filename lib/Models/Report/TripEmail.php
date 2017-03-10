<?php

namespace Automile\Sdk\Models\Report;

use Automile\Sdk\Models\ModelAbstract;

/**
 * TripEmail Report Model
 *
 * @method int getVehicleId()
 * @method int getPeriod()
 * @method string getToEmail()
 * @method string getISO639LanguageCode()
 * @method bool getExcludeDetailsForPersonalTrips()
 * @method bool getExcludeEnvironmentalAndFuelData()
 *
 * @method TripEmail setVehicleId(int $vehicleId)
 * @method TripEmail setPeriod(int $period)
 * @method TripEmail setToEmail(string $email)
 * @method TripEmail setISO639LanguageCode(string $code)
 * @method TripEmail setExcludeDetailsForPersonalTrips(bool $exclude)
 * @method TripEmail setExcludeEnvironmentalAndFuelData(bool $exclude)
 */
class TripEmail extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleId",
        "Period",
        "ToEmail",
        "ISO639LanguageCode",
        "ExcludeDetailsForPersonalTrips",
        "ExcludeEnvironmentalAndFuelData"
    ];

}
