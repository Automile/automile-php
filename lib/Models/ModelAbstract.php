<?php

namespace Automile\Sdk\Models;

/**
 * Abstract class to be inherited by all models
 * @package Automile\Sdk\Models
 */
abstract class ModelAbstract
{

    /**
     * @var array
     */
    protected $_properties = [];

    /**
     * list of properties allowed for auto assignment
     * @var array
     */
    protected $_allowedProperties = [];

    /**
     * @param array|object $properties array or object to load properties from
     */
    public function __construct($properties)
    {
        foreach ($properties as $key => $value) {
            if (!in_array($key, $this->_allowedProperties)) {
                continue;
            }

            $methodName = 'set' . ucfirst($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            } else {
                $this->_properties[$key] = $value;
            }
        }
    }

    /**
     * @param string $method
     * @param array $args
     * @return ModelAb|string|null
     * @throws ModelException
     */
    public function __call($method, array $args)
    {
        $prefix = substr($method, 0, 3);
        $property = substr($method, 3);

        if ($prefix && $property) {
            if (in_array($property, $this->_allowedProperties)) {
                switch ($prefix) {
                    case 'set':
                        if (count($args) == 1) {
                            $this->_properties[$property] = reset($args);
                            return $this;
                        }
                        break;
                    case 'get':
                        return empty($this->_properties[$property]) ? null : $this->_properties[$property];
                }
            }
        }

        throw new ModelException("Method '{$method}' not found");
    }

}
