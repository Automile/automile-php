<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\Vehicle\DefectRowset;
use Automile\Sdk\Models\Vehicle\Inspection;
use Automile\Sdk\Models\Vehicle\InspectionRowset;
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
        $this->assertInstanceOf(\DateTime::class, $inspection->getVehicleDefects()[0]->getDefectDateUtc());

        $this->assertInstanceOf(InspectionStatusRowset::class, $inspection->getInspectionStatus());
        $this->assertGreaterThan(0, count($inspection->getInspectionStatus()));
        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionStatus()[0]->getStatusDateUtc());
    }

    public function testGetByInspectionIdVehicleAndDate()
    {
        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(self::_getSettings('vehicle_inspection.id'));
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertEquals(1, count($inspections));
    }

}
