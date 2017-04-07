<?php

namespace Automile\Sdk\Models\Report;


use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleSummary Report Model
 *
 * @method int getVehicleId()
 * @method int setVehicleId()
 * @method DistanceRowset getDistanceReports()
 * @method FuelRowset getFuelReports()
 * @method TravelTimeRowset getTravelTimeReports()
 * @method CO2Rowset getCO2Reports()
 * @method IdleTimeRowset getIdleTimeReports()
 */
class VehicleSummary extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleId',
        'DistanceReports',
        'FuelReports',
        'TravelTimeReports',
        'CO2Reports',
        'IdleTimeReports'
    ];

    /**
     * @param array|object $rows
     * @return VehicleSummary
     */
    public function setDistanceReports($rows)
    {
        if (!is_object($rows) || !$rows instanceof DistanceRowset) {
            $rows = new DistanceRowset($rows);
        }

        $this->_properties['DistanceReports'] = $rows;
        return $this;
    }

    /**
     * @param array|object $rows
     * @return VehicleSummary
     */
    public function setFuelReports($rows)
    {
        if (!is_object($rows) || !$rows instanceof FuelRowset) {
            $rows = new FuelRowset($rows);
        }

        $this->_properties['FuelReports'] = $rows;
        return $this;
    }

    /**
     * @param array|object $rows
     * @return VehicleSummary
     */
    public function setTravelTimeReports($rows)
    {
        if (!is_object($rows) || !$rows instanceof TravelTimeRowset) {
            $rows = new TravelTimeRowset($rows);
        }

        $this->_properties['TravelTimeReports'] = $rows;
        return $this;
    }

    /**
     * @param array|object $rows
     * @return VehicleSummary
     */
    public function setCO2Reports($rows)
    {
        if (!is_object($rows) || !$rows instanceof CO2Rowset) {
            $rows = new CO2Rowset($rows);
        }

        $this->_properties['CO2Reports'] = $rows;
        return $this;
    }

    /**
     * @param array|object $rows
     * @return VehicleSummary
     */
    public function setIdleTimeReports($rows)
    {
        if (!is_object($rows) || !$rows instanceof IdleTimeRowset) {
            $rows = new IdleTimeRowset($rows);
        }

        $this->_properties['IdleTimeReports'] = $rows;
        return $this;
    }

}
