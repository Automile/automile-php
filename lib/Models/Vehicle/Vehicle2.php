<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Vehicle2 Model
 * 
 * @method int getVehicleId()
 * @method string getVehicleIdentificationNumber()
 * @method string getNumberPlate()
 * @method string getMake()
 * @method string getModel()
 * @method int getOwnerContactId()
 * @method int getOwnerCompanyId()
 * @method float getCurrentOdometerInKilometers()
 * @method string getUserVehicleIdentificationNumber()
 * @method int getModelYear()
 * @method string getBodyStyle()
 * @method int getFuelType()
 * @method int getDefaultTripType()
 * @method bool getAllowAutomaticUpdates()
 * @method int getDefaultPrivacyPolicyType()
 * @method int getCheckedInContactId()
 * @method bool getIsEditable()
 * @method string getMakeImageUrl()
 * @method int getTransferIntervalInSeconds()
 * @method bool getSampleHarshEvents()
 * @method array getFeatures()
 * @method bool getAllowSpeedRecording()
 * @method string getNickname()
 * @method int getCategoryColor()
 * @method string getTags()
 *
 * @method Vehicle2 setVehicleId(int $vehicleId)
 * @method Vehicle2 setVehicleIdentificationNumber(string $vin)
 * @method Vehicle2 setNumberPlate(string $plate)
 * @method Vehicle2 setMake(string $make)
 * @method Vehicle2 setModel(string $model)
 * @method Vehicle2 setOwnerContactId(int $contactId)
 * @method Vehicle2 setOwnerCompanyId(int $companyId)
 * @method Vehicle2 setCurrentOdometerInKilometers(float $km)
 * @method Vehicle2 setUserVehicleIdentificationNumber(string $vin)
 * @method Vehicle2 setModelYear(int $year)
 * @method Vehicle2 setBodyStyle(string $style)
 * @method Vehicle2 setFuelType(int $type)
 * @method Vehicle2 setDefaultTripType(int $type)
 * @method Vehicle2 setAllowAutomaticUpdates(bool $allow)
 * @method Vehicle2 setDefaultPrivacyPolicyType(int $type)
 * @method Vehicle2 setCheckedInContactId(int $contactId)
 * @method Vehicle2 setIsEditable(bool $isEditable)
 * @method Vehicle2 setMakeImageUrl(string $url)
 * @method Vehicle2 setTransferIntervalInSeconds(int $interval)
 * @method Vehicle2 setSampleHarshEvents(bool $sample)
 * @method Vehicle2 setFeatures(array $features)
 * @method Vehicle2 setAllowSpeedRecording(bool $allow)
 * @method Vehicle2 setNickname(string $nickname)
 * @method Vehicle2 setCategoryColor(int $color)
 * @method Vehicle2 setTags(string $tags)
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
