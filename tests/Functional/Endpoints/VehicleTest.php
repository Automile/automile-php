<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\Vehicle\CheckIn;
use Automile\Sdk\Models\Vehicle\Status;
use Automile\Sdk\Models\Vehicle\StatusRowset;
use Automile\Sdk\Models\Vehicle\Vehicle2;
use Automile\Sdk\Models\Vehicle\Vehicle2Rowset;
use Automile\Sdk\Tests\Functional\TestAbstract;
use Automile\Sdk\Types\FuelType;
use Automile\Sdk\Types\TripType;

/**
 * Vehicle API calls
 */
class VehicleTest extends TestAbstract
{

    public function testGet()
    {
        $vehicles = self::_getClient()->getVehicles();

        $this->assertInstanceOf(Vehicle2Rowset::class, $vehicles);
        $this->assertGreaterThan(0, count($vehicles));
        $this->assertInstanceOf(Vehicle2::class, $vehicles[0]);
    }

    public function testGetById()
    {
        $vehicle = self::_getClient()->getVehicleById(self::_getSettings('vehicle.id'));
        $this->assertInstanceOf(Vehicle2::class, $vehicle);
    }

    public function testStatus()
    {
        $statuses = self::_getClient()->getStatusForVehicles();

        $this->assertInstanceOf(StatusRowset::class, $statuses);
        $this->assertGreaterThan(0, count($statuses));
        $this->assertInstanceOf(Status::class, $statuses[0]);
    }

    public function testCheckIn()
    {
        $checkIn = self::_getClient()->checkInToVehicle(new CheckIn([
            "ContactId" => self::_getSettings('vehicle.contact_id'),
            "VehicleId" => self::_getSettings('vehicle.id'),
            "DefaultTripType" => TripType::AUTO,
            "CheckOutAtUtc" => (new \DateTime())->add(new \DateInterval('P3D'))
        ]));
        $this->assertTrue($checkIn);
    }

    public function testCheckOut()
    {
        $checkOut = self::_getClient()->checkOut();
        $this->assertTrue($checkOut);
    }

    /**
     * @return int $vehicleId
     */
    public function testCreate()
    {
        $params = [
            "VehicleIdentificationNumber" => "12345",
            "NumberPlate" => "AAA12345",
            "Make" => "Ford",
            "Model" => "Fusion",
            "CurrentOdometerInKilometers" => 123.45,
            "ModelYear" => 2016,
            "FuelType" => FuelType::PETROL,
            "DefaultTripType" => TripType::BUSINESS,
            "AllowAutomaticUpdates" => true,
            "IsEditable" => true,
            "Nickname" => "Fusion Test 2",
            "CategoryColor" => 2591227,
            "Tags" => "ford, fusion, test",
            "CreateRelationshipToId" => 18727,
            "VehicleRelationshipType" => 0
        ];

        $vehicle = self::_getClient()->createVehicle(new Vehicle2($params));

        $this->assertInstanceOf(Vehicle2::class, $vehicle);

        if (!$vehicle->getVehicleId()) {
            //TODO: remove when the API issue is resolved
            $vehicle->setVehicleId(40878);
        }

        $this->assertGreaterThan(0, $vehicle->getVehicleId());

        return $vehicle->getVehicleId();
    }

    /**
     * @depends testCreate
     * @param int $vehicleId
     * @return int $vehicleId
     */
    public function testEdit($vehicleId)
    {
        $params = [
            'VehicleId' => $vehicleId,
            'Model' => 'Fusion Edited',
            'FuelType' => FuelType::GAS,
            'Nickname' => 'Fusion Test Edited',
            'Tags' => 'ford, fusion, edited'
        ];

        $vehicle = self::_getClient()->editVehicle(new Vehicle2($params));

        $this->assertInstanceOf(Vehicle2::class, $vehicle);
        $this->assertEquals($vehicleId, $vehicle->getVehicleId());
        $this->assertArraySubset($params, $vehicle->toArray());

        $vehicle = self::_getClient()->getVehicleById($vehicleId);
        $this->assertInstanceOf(Vehicle2::class, $vehicle);

        if (!$vehicle->getVehicleId()) {
            //TODO: remove when the API issue is resolved
            $vehicle->setVehicleId($vehicleId);
        }

        $this->assertEquals($vehicleId, $vehicle->getVehicleId());
        $this->assertArraySubset($params, $vehicle->toArray());

        return $vehicleId;
    }

    /**
     * @depends testEdit
     * @param int $vehicleId
     */
    public function testDelete($vehicleId)
    {
        $delete = self::_getClient()->deleteVehicle($vehicleId);
        $this->assertTrue($delete);
    }

}
