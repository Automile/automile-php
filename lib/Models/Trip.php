<?php

namespace Automile\Sdk\Models;

/**
 * Trip Model
 * @package Automile\Sdk\Models
 * @method int getTripId()
 * @method int getVehicleId()
 */
class Trip extends ModelAbstract
{

    protected $_allowedProperties = [
        "TripId",
        "IMEI",
        "TripStartDateTime",
        "TripStartTimeZone",
        "TripStartODOMeter",
        "TripNumber",
        "NumberOfSupportedPIDs",
        "VehicleIdentificationNumber",
        "VechicleProtocol",
        "TripEndDateTime",
        "TripEndTimeZone",
        "TripEndODOMeter",
        "TripStartFormattedAddress",
        "TripEndFormattedAddress",
        "TripStartCustomAddress",
        "TripEndCustomAddress",
        "TripType",
        "TripTags",
        "VehicleId",
        "FuelInLiters",
        "TripLengthInKilometers",
        "TripLengthInMinutes",
        "IdleTimeInSecondsAllTrip",
        "IdleTimeInSecondsFromStart",
        "IdleRPMMax",
        "MaxSpeed",
        "MaxRPM",
        "CO2EmissionInGrams",
        "OdometerInKilometersAfterTripEnded",
        "AverageSpeedInKilometersPerHour",
        "TripStartOutsideTemperatureInCelsius",
        "DriverContactId",
        "HasDrivingEvents",
        "CustomCategory",
        "HideStartRoute",
        "HideEndRoute",
        "LastEditedByContactId"
    ];

}