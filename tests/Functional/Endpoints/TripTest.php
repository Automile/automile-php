<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\Trip;
use Automile\Sdk\Models\TripRowset;
use Automile\Sdk\Models\TripStartEndGeo;
use Automile\Sdk\Models\Vehicle\RPM;
use Automile\Sdk\Models\Vehicle\RPMRowset;
use Automile\Sdk\Models\Vehicle\Speed;
use Automile\Sdk\Models\Vehicle\SpeedRowset;
use Automile\Sdk\Tests\Functional\TestAbstract;

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
        $this->greaterThan(0, count($speedRowset));

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
        $this->greaterThan(0, count($rpmRowset));

        $rpm = $rpmRowset[0];
        $this->assertInstanceOf(RPM::class, $rpm);
        $this->assertInternalType('float', $rpm->getRPMValue());
        $this->assertInstanceOf(\DateTime::class, $rpm->getRecordTimeStamp());
    }

}
