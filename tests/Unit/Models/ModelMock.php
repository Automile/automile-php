<?php

namespace Automile\Sdk\Tests\Unit\Models;

use Automile\Sdk\Models\ModelAbstract;

/**
 * Mock Model
 */
class ModelMock extends ModelAbstract
{

    protected $_allowedProperties = [
        'Property1',
        'Property2',
        'Property3',
        'Property4'
    ];

    /**
     * setter test method
     * @param string $value
     * @return ModelMock
     */
    public function setProperty4($value)
    {
        $this->_properties['Property4'] = $value . '-setter';
        return $this;
    }

    /**
     * getter test method
     * @return string
     */
    public function getProperty4()
    {
        return array_key_exists('Property4', $this->_properties)
            ? $this->_properties['Property4'] . '-getter'
            : null;
    }

}
