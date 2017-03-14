<?php

namespace Automile\Sdk\Models\Vehicle;

use Automile\Sdk\Models\ModelAbstract;

/**
 * VehicleHealth Model
 *
 * @see \Automile\Sdk\Types\BatteryEventStatusType
 *
 * @method int getVehicleId()
 * @method int getPeriodFrom()
 * @method int getPeriodTo()
 * @method int getLastBatteryStatus()
 * @method BatteryEvent getLastBatteryWarning()
 * @method BatteryEventRowset getBatteryEventsForSelectedPeriod()
 * @method MilEvent getLastMILEvent()
 * @method MilEventRowset getMILEventsForSelectedPeriod()
 * @method DtcEvent getLastDTCEvent()
 * @method DtcEvent getLastPendingDTCEvent()
 * @method DtcEventDetailRowset getDTCEventsForSelectedPeriod()
 * @method DtcEventDetailRowset getPendingDTCEventsForSelectedPeriod()
 *
 * @method Health setVehicleId(int $vehicleId)
 * @method Health setPeriodFrom(int $periodFrom)
 * @method Health setPeriodTo(int $periodTo)
 * @method Health setLastBatteryStatus(int $status)
 */
class Health extends ModelAbstract
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
     * @return Health
     */
    public function setLastBatteryWarning($property)
    {
        if (!is_object($property) || !$property instanceof BatteryEvent) {
            $property = new BatteryEvent($property);
        }

        $this->_properties['LastBatteryWarning'] = $property;
        return $this;
    }

    /**
     * @param array|object $events
     * @return Health
     */
    public function setBatteryEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof BatteryEventRowset) {
            $events = new BatteryEventRowset($events);
        }

        $this->_properties['BatteryEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $event
     * @return Health
     */
    public function setLastMILEvent($event)
    {
        if (!is_object($event) || !$event instanceof MilEvent) {
            $event = new MilEvent($event);
        }

        $this->_properties['LastMILEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $events
     * @return Health
     */
    public function setMILEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof MilEventRowset) {
            $events = new MilEventRowset($events);
        }

        $this->_properties['MILEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $event
     * @return Health
     */
    public function setLastDTCEvent($event)
    {
        if (!is_object($event) || !$event instanceof DtcEvent) {
            $event = new DtcEvent($event);
        }

        $this->_properties['LastDTCEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $event
     * @return Health
     */
    public function setLastPendingDTCEvent($event)
    {
        if (!is_object($event) || !$event instanceof DtcEvent) {
            $event = new DtcEvent($event);
        }

        $this->_properties['LastPendingDTCEvent'] = $event;
        return $this;
    }

    /**
     * @param array|object $events
     * @return Health
     */
    public function setDTCEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof DtcEventDetailRowset) {
            $events = new DtcEventDetailRowset($events);
        }

        $this->_properties['DTCEventsForSelectedPeriod'] = $events;
        return $this;
    }

    /**
     * @param array|object $events
     * @return Health
     */
    public function setPendingDTCEventsForSelectedPeriod($events)
    {
        if (!is_object($events) || !$events instanceof DtcEventDetailRowset) {
            $events = new DtcEventDetailRowset($events);
        }

        $this->_properties['PendingDTCEventsForSelectedPeriod'] = $events;
        return $this;
    }

}
