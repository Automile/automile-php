<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\GeofenceReport;
use Automile\Sdk\Models\GeofenceReportRecord;
use Automile\Sdk\Models\GeofenceReportRecordRowset;
use Automile\Sdk\Models\Report\TripSummary;
use Automile\Sdk\Models\Report\TripSummaryRowset;
use Automile\Sdk\Tests\Functional\TestAbstract;

/**
 * Report API Calls
 */
class ReportTest extends TestAbstract
{

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
