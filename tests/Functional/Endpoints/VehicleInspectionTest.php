<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\Vehicle\Defect;
use Automile\Sdk\Models\Vehicle\DefectRowset;
use Automile\Sdk\Models\Vehicle\Inspection;
use Automile\Sdk\Models\Vehicle\InspectionRowset;
use Automile\Sdk\Models\Vehicle\InspectionStatus;
use Automile\Sdk\Models\Vehicle\InspectionStatusRowset;
use Automile\Sdk\Tests\Functional\TestAbstract;

/**
 * VehicleInspection API Calls
 */
class VehicleInspectionTest extends TestAbstract
{

    public function ntestGetById()
    {
        $inspection = self::_getClient()->getByInspectionId(self::_getSettings('vehicle_inspection.id'));

        $this->assertInstanceOf(Inspection::class, $inspection);
        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionDateUtc());

        $this->assertInstanceOf(DefectRowset::class, $inspection->getVehicleDefects());
        $this->assertGreaterThan(0, count($inspection->getVehicleDefects()));
        $this->assertInstanceOf(Defect::class, $inspection->getVehicleDefects()[0]);
        $this->assertInstanceOf(\DateTime::class, $inspection->getVehicleDefects()[0]->getDefectDateUtc());

        $this->assertInstanceOf(InspectionStatusRowset::class, $inspection->getInspectionStatus());
        $this->assertGreaterThan(0, count($inspection->getInspectionStatus()));
        $this->assertInstanceOf(InspectionStatus::class, $inspection->getInspectionStatus()[0]);
        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionStatus()[0]->getStatusDateUtc());
    }

    public function testGetByInspectionIdVehicleAndDate()
    {
        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(self::_getSettings('vehicle_inspection.id'));
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertEquals(1, count($inspections));
        $this->assertInstanceOf(Inspection::class, $inspections[0]);

        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(null, self::_getSettings('vehicle_inspection.vehicle_id'));
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertGreaterThan(0, count($inspections));
        $this->assertInstanceOf(Inspection::class, $inspections[0]);

        $startDate = new \DateTime('2017-01-01');
        $endDate = new \DateTime('2017-02-01');
        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(null, null, $startDate, $endDate);
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertGreaterThan(0, count($inspections));
        foreach ($inspections as $inspection) {
            $this->assertInstanceOf(Inspection::class, $inspection);
            $this->assertGreaterThanOrEqual($startDate, $inspection->getInspectionDateUtc());
            $this->assertLessThanOrEqual($endDate, $inspection->getInspectionDateUtc());
        }
    }

}
