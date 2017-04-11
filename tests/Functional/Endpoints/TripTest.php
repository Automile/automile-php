<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\AmbientAirTemperature;
use Automile\Sdk\Models\AmbientAirTemperatureRowset;
use Automile\Sdk\Models\Trip;
use Automile\Sdk\Models\TripGeo;
use Automile\Sdk\Models\TripGeoRowset;
use Automile\Sdk\Models\TripPID;
use Automile\Sdk\Models\TripPIDRowset;
use Automile\Sdk\Models\TripRowset;
use Automile\Sdk\Models\TripStartEndGeo;
use Automile\Sdk\Models\Vehicle\EngineCoolantTemperature;
use Automile\Sdk\Models\Vehicle\EngineCoolantTemperatureRowset;
use Automile\Sdk\Models\Vehicle\FuelLevelInput;
use Automile\Sdk\Models\Vehicle\FuelLevelInputRowset;
use Automile\Sdk\Models\Vehicle\RPM;
use Automile\Sdk\Models\Vehicle\RPMRowset;
use Automile\Sdk\Models\Vehicle\Speed;
use Automile\Sdk\Models\Vehicle\SpeedRowset;
use Automile\Sdk\Tests\Functional\TestAbstract;
use Automile\Sdk\Types\TripType;

class TripTest extends TestAbstract
{

    public function testGet()
    {
        $trips = self::_getClient()->getTrips(10);

        $this->assertInstanceOf(TripRowset::class, $trips);
        $this->assertGreaterThan(0, count($trips));
        $this->assertInstanceOf(Trip::class, $trips[0]);
    }

    public function testGetById()
    {
        $tripId = self::_getSettings('trip.id');

        $trip = self::_getClient()->getTripById($tripId);
        $this->assertInstanceOf(Trip::class, $trip);
        $this->assertEquals($tripId, $trip->getTripId());
    }

    public function testGetTripStartStopLatitudeLongitude()
    {
        $geo = self::_getClient()->getTripStartStopLatitudeLongitude(self::_getSettings('trip.id'));
        $this->assertInstanceOf(TripStartEndGeo::class, $geo);
        $this->assertInternalType('float', $geo->getStartLatitude());
        $this->assertInternalType('float', $geo->getStartLongitude());
        $this->assertInternalType('float', $geo->getEndLatitude());
        $this->assertInternalType('float', $geo->getEndLongitude());
    }

    public function testGetTripSpeed()
    {
        $tripId = self::_getSettings('trip.id');

        $speedRowset = self::_getClient()->getTripSpeed($tripId);
        $this->assertInstanceOf(SpeedRowset::class, $speedRowset);
        $this->assertGreaterThan(0, count($speedRowset));

        $speed = $speedRowset[0];
        $this->assertInstanceOf(Speed::class, $speed);
        $this->assertInternalType('float', $speed->getSpeedKmPerHour());
        $this->assertInstanceOf(\DateTime::class, $speed->getRecordTimeStamp());
    }

    public function testGetTripRPM()
    {
        $tripId = self::_getSettings('trip.id');

        $rpmRowset = self::_getClient()->getTripRPM($tripId);
        $this->assertInstanceOf(RPMRowset::class, $rpmRowset);
        $this->assertGreaterThan(0, count($rpmRowset));

        $rpm = $rpmRowset[0];
        $this->assertInstanceOf(RPM::class, $rpm);
        $this->assertInternalType('float', $rpm->getRPMValue());
        $this->assertInstanceOf(\DateTime::class, $rpm->getRecordTimeStamp());
    }

    public function testGetTripAmbientTemperature()
    {
        $tripId = self::_getSettings('trip.id');

        $tempRowset = self::_getClient()->getTripAmbientTemperature($tripId);
        $this->assertInstanceOf(AmbientAirTemperatureRowset::class, $tempRowset);
        $this->assertGreaterThan(0, count($tempRowset));

        $temp = $tempRowset[0];
        $this->assertInstanceOf(AmbientAirTemperature::class, $temp);
        $this->assertInternalType('float', $temp->getTemperatureInCelsius());
        $this->assertInstanceOf(\DateTime::class, $temp->getRecordTimeStamp());
    }

    public function testGetTripFuelLevel()
    {
        $tripId = self::_getSettings('trip.id');

        $fuelRowset = self::_getClient()->getTripFuelLevel($tripId);
        $this->assertInstanceOf(FuelLevelInputRowset::class, $fuelRowset);
    }

    public function testGetTripEngineCoolantTemperature()
    {
        $tripId = self::_getSettings('trip.id');

        $coolantRowset = self::_getClient()->getTripEngineCoolantTemperature($tripId);
        $this->assertInstanceOf(EngineCoolantTemperatureRowset::class, $coolantRowset);
        $this->assertGreaterThan(0, count($coolantRowset));

        $coolant = $coolantRowset[0];
        $this->assertInstanceOf(EngineCoolantTemperature::class, $coolant);
        $this->assertInternalType('float', $coolant->getTemperatureInCelsius());
        $this->assertInstanceOf(\DateTime::class, $coolant->getRecordTimeStamp());
    }

    public function testGetTripPIDRaw()
    {
        $tripId = self::_getSettings('trip.id');
        $pidId = self::_getSettings('trip.pid_id');

        $pidRowset = self::_getClient()->getTripPIDRaw($tripId, $pidId);
        $this->assertInstanceOf(TripPIDRowset::class, $pidRowset);
    }

    public function testGeoTripLatitudeLongitude()
    {
        $tripId = self::_getSettings('trip.id');

        $geoRowset = self::_getClient()->geoTripLatitudeLongitude($tripId);
        $this->assertInstanceOf(TripGeoRowset::class, $geoRowset);
        $this->assertGreaterThan(0, count($geoRowset));

        $geo = $geoRowset[0];
        $this->assertInstanceOf(TripGeo::class, $geo);
        $this->assertInternalType('float', $geo->getLatitude());
        $this->assertInternalType('float', $geo->getLongitude());
        $this->assertInternalType('int', $geo->getHeadingDegrees());
        $this->assertInternalType('int', $geo->getNumberOfSatellites());
        $this->assertInternalType('int', $geo->getHDOP());
        $this->assertInstanceOf(\DateTime::class, $geo->getRecordTimeStamp());
    }

    public function testEdit()
    {
        $params = [
            'TripId' => self::_getSettings('trip.id'),
            'TripTags' => ['tag6', 'tag5', 'tag4'],
            'TripType' => TripType::BUSINESS
        ];

        $trip = self::_getClient()->editTrip(new Trip($params));

        $this->assertInstanceOf(Trip::class, $trip);
        $this->assertEquals($params['TripId'], $trip->getTripId());

        $trip = self::_getClient()->getTripById($params['TripId']);
        $this->assertInstanceOf(Trip::class, $trip);
        $this->assertEquals($params['TripId'], $trip->getTripId());
        $this->assertEquals($params['TripType'], $trip->getTripType());
        $this->assertEquals($params['TripTags'], explode(',', $trip->getTripTags()));
    }

}
