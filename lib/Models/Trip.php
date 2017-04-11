<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Types\TripType;

/**
 * Trip Model
 *
 * @see TripType
 * 
 * @method int getTripId()
 * @method string getIMEI()
 * @method string getTripStartDateTime()
 * @method int getTripStartTimeZone()
 * @method int getTripStartODOMeter()
 * @method int getTripNumber()
 * @method string getNumberOfSupportedPIDs()
 * @method string getVehicleIdentificationNumber()
 * @method string getVechicleProtocol()
 * @method string getTripEndDateTime()
 * @method int getTripEndTimeZone()
 * @method int getTripEndODOMeter()
 * @method string getTripStartFormattedAddress()
 * @method string getTripEndFormattedAddress()
 * @method string getTripStartCustomAddress()
 * @method string getTripEndCustomAddress()
 * @method int getTripType()
 * @method string|array getTripTags()
 * @method int getVehicleId()
 * @method float getFuelInLiters()
 * @method float getTripLengthInKilometers()
 * @method int getTripLengthInMinutes()
 * @method int getIdleTimeInSecondsAllTrip()
 * @method int getIdleTimeInSecondsFromStart()
 * @method int getIdleRPMMax()
 * @method string getMaxSpeed()
 * @method int getMaxRPM()
 * @method float getCO2EmissionInGrams()
 * @method float getOdometerInKilometersAfterTripEnded()
 * @method float getAverageSpeedInKilometersPerHour()
 * @method float getTripStartOutsideTemperatureInCelsius()
 * @method int getDriverContactId()
 * @method bool getHasDrivingEvents()
 * @method string getCustomCategory()
 * @method bool getHideStartRoute()
 * @method bool getHideEndRoute()
 *
 * @method int setTripId(int $tripId)
 * @method string setIMEI(string $imei)
 * @method string setTripStartDateTime(string $dateTime)
 * @method int setTripStartTimeZone(int $timeZone)
 * @method int setTripStartODOMeter(int $odometer)
 * @method int setTripNumber(int $tripNumber)
 * @method string setNumberOfSupportedPIDs(string $pid)
 * @method string setVehicleIdentificationNumber(string $vin)
 * @method string setVechicleProtocol(string $protocol)
 * @method string setTripEndDateTime(string $dateTime)
 * @method int setTripEndTimeZone(int $timeZone)
 * @method int setTripEndODOMeter(int $odometer)
 * @method string setTripStartFormattedAddress(string $address)
 * @method string setTripEndFormattedAddress(string $address)
 * @method string setTripStartCustomAddress(string $address)
 * @method string setTripEndCustomAddress(string $address)
 * @method int setTripType(int $tripType)
 * @method string|array setTripTags(string $tags)
 * @method int setVehicleId(int $vehicleId)
 * @method float setFuelInLiters(float $liters)
 * @method float setTripLengthInKilometers(float $kilometers)
 * @method int setTripLengthInMinutes(int $minutes)
 * @method int setIdleTimeInSecondsAllTrip(int $seconds)
 * @method int setIdleTimeInSecondsFromStart(int $seconds)
 * @method int setIdleRPMMax(int $rpm)
 * @method string setMaxSpeed(string $speed)
 * @method int setMaxRPM(int $rpm)
 * @method float setCO2EmissionInGrams(float $grams)
 * @method float setOdometerInKilometersAfterTripEnded(float $kilometers)
 * @method float setAverageSpeedInKilometersPerHour(float $kilometers)
 * @method float setTripStartOutsideTemperatureInCelsius(float $temperature)
 * @method int setDriverContactId(int $contactId)
 * @method bool setHasDrivingEvents(bool $events)
 * @method string setCustomCategory(string $category)
 * @method bool setHideStartRoute(bool $hide)
 * @method bool setHideEndRoute(bool $hide)
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