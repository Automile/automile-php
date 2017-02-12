<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 2017-02-09
 * Time: 11:16
 */

namespace Automile\Sdk\Models;

/**
 * Vehicle2 Model
 * @package Automile\Sdk\Models
 * @method int getVehicleId()
 * @method string getVehicleIdentificationNumber()
 * @method string getNumberPlate()
 * @method string getMake()
 * @method string getModel()
 * @method int getOwnerContactId()
 * @method int getOwnerCompanyId()
 */
class Vehicle2 extends ModelAbstract
{

    protected $_allowedProperties = [
        "VehicleId",
        "VehicleIdentificationNumber",
        "NumberPlate",
        "Make",
        "Model",
        "OwnerContactId",
        "OwnerCompanyId",
        "CurrentOdometerInKilometers",
        "UserVehicleIdentificationNumber",
        "ModelYear",
        "BodyStyle",
        "FuelType",
        "DefaultTripType",
        "AllowAutomaticUpdates",
        "DefaultPrivacyPolicyType",
        "CheckedInContactId",
        "IsEditable",
        "MakeImageUrl",
        "TransferIntervalInSeconds",
        "SampleHarshEvents",
        "Features",
        "AllowSpeedRecording",
        "Nickname",
        "CategoryColor",
        "Tags",
        "OwnedByName",
        "NumberOfTrips",
        "DistanceTravelledThisYear",
        "DistanceTravelledLastYear",
        "LastKnownLatitude",
        "LastKnownLongitude",
        "LastKnownGeoTimeStamp",
        "LastKnownFormattedAddress",
        "LastKnownCustomAddress",
        "LastKnownSpeed",
        "LastKnownTemperature",
        "LastKnownTemperatureTimeStamp",
        "LastTripEndLatitude",
        "LastTripEndLongitude",
        "LastTripStartGeoTimeStamp",
        "LastTripEndGeoTimeStamp",
        "ParkedForNumberOfSeconds",
        "OngoingTripId",
        "LastTripId",
        "AquiredDate",
        "YearlyTax",
        "LastSyncUtcWithVehicleExternalInformation",
        "NumberOfOwners",
        "Status1",
        "RegisteredInISO3166CountryCode",
        "AllowAutomaticVehicleExternalInformationUpdate",
        "CO2Urban",
        "CO2UrbanExtra",
        "CO2Combined",
        "FrontTyre",
        "RearTyre",
        "FrontWheelRim",
        "RearWheelRim",
        "TrailerHitch",
        "TrailerHitchMaxLoadKgWithoutBreaks",
        "TrailerHitchMaxLoadKgWithDefaultDriversLicence",
        "TrailerHitchMaxLoadKgWithAlternativeDriversLicence",
        "InspectionPeriodStart",
        "InspectionPeriodEnd",
        "Owner",
        "OwnerType",
        "LeaseCompany",
        "InsuranceCompany",
        "EngineSizekW",
        "DisplacementCm3",
        "VehicleMatureTax",
        "VehicleTax",
        "MaxNumberOfPassengers",
        "CurbWeightKg",
        "GrossWeightKg",
        "TaxWeightKg",
        "MaxGrossWeightWithTrailerKg",
        "IsImported",
        "FirstDateRegisteredInCurrentCountry",
        "VehicleManufacturedDate",
        "PaintColor",
        "AllowTripDrivingEventRecording",
        "InsuranceDate",
        "TrailerHitchMaxWeightKg",
        "LastInspectionDate",
        "LastTripIdCheckedInContact",
        "FuelConsumptionCombinedLiters",
        "TransmissionType",
        "PriceExcludingEquipmentLocalCurrency",
        "AverageTripDistanceKm",
        "AverigeTripIdleTimeSeconds",
        "AverageFuelConsumptionLiter",
        "CreateRelationshipToId",
        "VehicleRelationshipType"
    ];

}
