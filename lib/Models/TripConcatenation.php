<?php

namespace Automile\Sdk\Models;

/**
 * TripConcatenation Model
 * @package Automile\Sdk\Models
 */
class TripConcatenation extends ModelAbstract
{

    protected $_allowedProperties = [
        "TripId",
        "VehicleId",
        "VehicleName",
        "MergedFromTripIds",
        "SpeedGroups",
        "SpeedPoints",
        "RawPoints",
        "SnappedToRoadPoints",
        "DrivingEvents",
        "SpeedData",
        "SpeedLimitData",
        "RPMData",
        "StartDateTime",
        "EndDateTime",
        "TripTimeZone",
        "StartFormattedAddress",
        "EndFormattedAddress",
        "StartCustomAddress",
        "EndCustomAddress",
        "Distance",
        "FuelConsumption",
        "LengthInMinutes",
        "DriverContactId",
        "DriverName",
        "IdleRPMAverage",
        "IdleTimeInSecondsForAllTrip",
        "IdleTimeInSecondsFromStart",
        "CO2Emission",
        "MaxSpeed",
        "MaxRPM",
        "ParkedForMinutesUntilNextTrip",
        "StartPoint",
        "EndPoint",
        "Notes",
        "TripType",
        "AverageSpeedInKilometersPerHour",
        "CustomCategory",
        "HideStartRoute",
        "HideEndRoute"
    ];

}
