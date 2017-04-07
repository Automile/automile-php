<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\GeofenceReport;
use Automile\Sdk\Models\GeofenceReportRecord;
use Automile\Sdk\Models\GeofenceReportRecordRowset;
use Automile\Sdk\Models\Report\CO2;
use Automile\Sdk\Models\Report\CO2Rowset;
use Automile\Sdk\Models\Report\Distance;
use Automile\Sdk\Models\Report\DistanceRowset;
use Automile\Sdk\Models\Report\Fuel;
use Automile\Sdk\Models\Report\FuelRowset;
use Automile\Sdk\Models\Report\IdleTime;
use Automile\Sdk\Models\Report\IdleTimeRowset;
use Automile\Sdk\Models\Report\TravelTime;
use Automile\Sdk\Models\Report\TravelTimeRowset;
use Automile\Sdk\Models\Report\TripEmail;
use Automile\Sdk\Models\Report\TripSummary;
use Automile\Sdk\Models\Report\TripSummaryRowset;
use Automile\Sdk\Models\Report\VehicleSummary;
use Automile\Sdk\Tests\Functional\TestAbstract;

/**
 * Report API Calls
 */
class ReportTest extends TestAbstract
{

    public function testGetTripSummaryReport()
    {
        $vehicleId = self::_getSettings('report.vehicle_id');
        $year = 2017;

        $reports = self::_getClient()->getTripSummaryReport($year, $vehicleId);

        $this->assertInstanceOf(TripSummaryRowset::class, $reports);
        $this->greaterThan(1, count($reports));

        $report = $reports[0];
        $this->assertInstanceOf(TripSummary::class, $report);
        $this->assertEquals($vehicleId, $report->getVehicleId());
        $this->assertStringStartsWith((string)$year, (string)$report->getReportStartPeriod());
        $this->assertStringStartsWith((string)$year, (string)$report->getReportEndPeriod());
    }

    public function testGetVehiclesSummaryReport()
    {
        $vehicleId = self::_getSettings('report.vehicle_id');
        $year = 2017;

        $summary = self::_getClient()->getVehiclesSummaryReport($year, $vehicleId);

        $this->assertInstanceOf(VehicleSummary::class, $summary);
        $this->assertEquals($vehicleId, $summary->getVehicleId());

        $this->assertInstanceOf(DistanceRowset::class, $summary->getDistanceReports());
        $this->assertGreaterThan(1, count($summary->getDistanceReports()));
        $distance = $summary->getDistanceReports()[0];
        $this->assertInstanceOf(Distance::class, $distance);
        $this->assertInternalType('float', $distance->getBusinessDistanceInKilometers());
        $this->assertInternalType('float', $distance->getPersonalDistanceInKilometers());
        $this->assertInternalType('float', $distance->getOtherDistanceInKilometers());
        $this->assertInternalType('int', $distance->getPeriod());
        $this->assertStringStartsWith((string)$year, (string)$distance->getPeriod());

        $this->assertInstanceOf(FuelRowset::class, $summary->getFuelReports());
        $this->assertGreaterThan(1, count($summary->getFuelReports()));
        $fuel = $summary->getFuelReports()[0];
        $this->assertInstanceOf(Fuel::class, $fuel);
        $this->assertInternalType('float', $fuel->getBusinessFuelInLiters());
        $this->assertInternalType('float', $fuel->getPersonalFuelInLiters());
        $this->assertInternalType('float', $fuel->getOtherFuelInLiters());
        $this->assertInternalType('int', $fuel->getPeriod());
        $this->assertStringStartsWith((string)$year, (string)$fuel->getPeriod());

        $this->assertInstanceOf(TravelTimeRowset::class, $summary->getTravelTimeReports());
        $this->assertGreaterThan(1, count($summary->getTravelTimeReports()));
        $time = $summary->getTravelTimeReports()[0];
        $this->assertInstanceOf(TravelTime::class, $time);
        $this->assertInternalType('int', $time->getBusinessTravelTimeInMinutes());
        $this->assertInternalType('int', $time->getPersonalTravelTimeInMinutes());
        $this->assertInternalType('int', $time->getOtherTravelTimeInMinutes());
        $this->assertInternalType('int', $time->getPeriod());
        $this->assertStringStartsWith((string)$year, (string)$time->getPeriod());

        $this->assertInstanceOf(CO2Rowset::class, $summary->getCO2Reports());
        $this->assertGreaterThan(1, count($summary->getCO2Reports()));
        $co2 = $summary->getCO2Reports()[0];
        $this->assertInstanceOf(CO2::class, $co2);
        $this->assertStringStartsWith((string)$year, (string)$co2->getPeriod());

        $this->assertInstanceOf(IdleTimeRowset::class, $summary->getIdleTimeReports());
        $this->assertGreaterThan(1, count($summary->getIdleTimeReports()));
        $idle = $summary->getIdleTimeReports()[0];
        $this->assertInstanceOf(IdleTime::class, $idle);
        $this->assertInternalType('int', $idle->getBusinessIdleTimeInMinutes());
        $this->assertInternalType('int', $idle->getPersonalIdleTimeInMinutes());
        $this->assertInternalType('int', $idle->getOtherIdleTimeInMinutes());
        $this->assertInternalType('int', $idle->getPeriod());
        $this->assertStringStartsWith((string)$year, (string)$idle->getPeriod());
    }

    public function testEmailTripReport()
    {
        $vehicleId = self::_getSettings('report.vehicle_id');
        $email = self::_getSettings('report.email');

        $model = new TripEmail([
            'VehicleId' => $vehicleId,
            'ToEmail' => $email,
            'ISO639LanguageCode' => 'en',
            'Period' => 201701
        ]);

        $this->assertEquals($vehicleId, $model->getVehicleId());
        $this->assertEquals($email, $model->getToEmail());

        $res = self::_getClient()->emailTripReport($model);
        $this->assertTrue($res);
    }

    public function testGetGeofenceLog()
    {
        $vehicleId = self::_getSettings('report.vehicle_id');
        $geofenceId = self::_getSettings('report.geofence_id');
        $dateStart = new \DateTime('2017-03-01', new \DateTimeZone('UTC'));
        $dateEnd = new \DateTime('2017-04-01', new \DateTimeZone('UTC'));

        $log = self::_getClient()->getGeofenceLog($vehicleId, $geofenceId, $dateStart, $dateEnd);

        $this->assertInstanceOf(GeofenceReport::class, $log);
        $this->assertEquals($vehicleId, $log->getVehicleId());
        $this->assertEquals($geofenceId, $log->getGeofenceId());
        $this->assertEquals($dateStart->format('Y-m-d'), $log->getFromDate()->format('Y-m-d'));
        $this->assertEquals($dateEnd->format('Y-m-d'), $log->getToDate()->format('Y-m-d'));

        $this->assertInstanceOf(GeofenceReportRecordRowset::class, $log->getResult());
        $this->assertGreaterThan(1, count($log->getResult()));

        $record = $log->getResult()[0];
        $this->assertInstanceOf(GeofenceReportRecord::class, $record);
        $this->assertEquals($geofenceId, $record->getGeofenceId());
        $this->greaterThanOrEqual($dateStart, $record->getEventDateTime());
        $this->lessThanOrEqual($dateEnd, $record->getEventDateTime());
    }

}
