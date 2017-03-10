<?php

namespace Automile\Sdk\Models;

/**
 * GeographicPosition Model
 *
 * @method float getLatitude()
 * @method float getLongitude()
 */
class GeographicPosition extends ModelAbstract
{

    protected $_allowedProperties = [
        'Latitude', 'Longitude'
    ];

    /**
     * @param float $lat
     * @return GeographicPosition
     * @throws ModelException
     */
    public function setLatitude($lat)
    {
        if ($lat > 90 || $lat < -90) {
            throw new ModelException("Latitude should be in range [-90, 90]");
        }

        $this->_properties['Latitude'] = $lat;

        return $this;
    }

    /**
     * @param float $lng
     * @return GeographicPosition
     * @throws ModelException
     */
    public function setLongitude($lng)
    {
        if ($lng > 180 || $lng < -180) {
            throw new ModelException("Longitude should be in range [-180, 180]");
        }

        $this->_properties['Longitude'] = $lng;

        return $this;
    }

}
