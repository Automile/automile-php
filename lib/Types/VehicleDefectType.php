<?php

namespace Automile\Sdk\Types;

/**
 * VehicleDefect Type
 */
class VehicleDefectType implements Type
{

    const OTHER = 0;
    const AIR_COMPRESSOR = 1;
    const AIR_LINES = 2;
    const BATTERY = 3;
    const BRAKE_ACCESSORIES = 4;
    const BRAKES = 5;
    const CLUTCH = 6;
    const DEFROSTER = 7;
    const DRIVE_LINE = 8;
    const ENGINE = 9;
    const FIFTH_WHEEL = 10;
    const FRONT_AXLE = 11;
    const FUEL_TANKS = 12;
    const HEATER = 13;
    const HORN = 14;
    const LIGHTS = 15;
    const MIRRORS = 16;
    const MUFFLER = 17;
    const OIL_PRESSURE = 18;
    const ON_BOARD_RECORDER = 19;
    const RADIATOR = 20;
    const REAR_END = 21;
    const REFLECTORS = 22;
    const SAFETY_EQUIPMENT = 23;
    const SPRINGS = 24;
    const STARTER = 25;
    const STEERING = 26;
    const TIRES = 27;
    const TRANSMISSION = 28;
    const WHEEL = 29;
    const WINDOWS = 30;
    const WINDSHIELD_WIPERS = 31;

    /**
     * @param int $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, range(0, 31));
    }

}
