<?php

namespace Automile\Sdk\Models;

/**
 * VehicleHealth Model
 * @package Automile\Sdk\Models
 */
class VehicleHealth extends ModelAbstract
{

    protected $_allowedProperties = [
        'VehicleId',
        'PeriodFrom',
        'PeriodTo',
        'LastBatteryStatus',
        'LastBatteryWarning',
        'BatteryEventsForSelectedPeriod',
        'LastMILEvent',
        'MILEventsForSelectedPeriod',
        'LastDTCEvent',
        'LastPendingDTCEvent',
        'DTCEventsForSelectedPeriod',
        'PendingDTCEventsForSelectedPeriod'
    ];

    /**
     * @param array|object $property
     * @return VehicleHealth
     */
    public function setLastBatteryWarning($property)
    {
        if (!is_object($property) || !$property instanceof VehicleBatteryEvent) {
            $property = new VehicleBatteryEvent($property);
        }

        $this->_properties['LastBatteryWarning'] = $property;
        return $this;
    }

    /**
     * @param array|object $events
     * @return VehicleHealth
     */
    public function setBatteryEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof VehicleBatteryEventRowset) {
            $events = new VehicleBatteryEventRowset($events);
        }

        $this->_properties['BatteryEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $event
     * @return VehicleHealth
     */
    public function setLastMILEvent($event)
    {
        if (!is_object($event) || !$event instanceof VehicleMilEvent) {
            $event = new VehicleMilEvent($event);
        }

        $this->_properties['LastMILEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $events
     * @return VehicleHealth
     */
    public function setMILEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof VehicleMilEventRowset) {
            $events = new VehicleMilEventRowset($events);
        }

        $this->_properties['MILEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $event
     * @return VehicleHealth
     */
    public function setLastDTCEvent($event)
    {
        if (!is_object($event) || !$event instanceof VehicleDtcEvent) {
            $event = new VehicleDtcEvent($event);
        }

        $this->_properties['LastDTCEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $event
     * @return VehicleHealth
     */
    public function setLastPendingDTCEvent($event)
    {
        if (!is_object($event) || !$event instanceof VehicleDtcEvent) {
            $event = new VehicleDtcEvent($event);
        }

        $this->_properties['LastPendingDTCEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $events
     * @return VehicleHealth
     */
    public function setDTCEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof VehicleDtcEventDetailRowset) {
            $events = new VehicleDtcEventDetailRowset($events);
        }

        $this->_properties['DTCEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $events
     * @return VehicleHealth
     */
    public function setPendingDTCEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof VehicleDtcEventDetailRowset) {
            $events = new VehicleDtcEventDetailRowset($events);
        }

        $this->_properties['PendingDTCEventsForSelectedPeriod'] = $events;
        return $this;
    }

}
