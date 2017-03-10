<?php

namespace Automile\Sdk\Models;

/**
 * Abstract class to be inherited by all models
 */
abstract class ModelAbstract
{

    /**
     * property values assigned to a model
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
    public function __construct($properties = [])
    {
        $this->_setProperties($properties);
    }

    /**
     * @param array|object $properties array or object to load properties from
     * @return ModelAbstract
     */
    public function reset($properties = [])
    {
        $this->_properties = [];
        $this->_setProperties($properties);
        return $this;
    }

    /**
     * @param array|object $properties array or object to load properties from
     * @return ModelAbstract
     */
    protected function _setProperties($properties)
    {
        $properties = (array)$properties;
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

        return $this;
    }

    /**
     * @param string $method
     * @param array $args
     * @return ModelAbstract|string|null
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

        throw new \BadMethodCallException("Method '{$method}' not found");
    }

    /**
     * JSON-encode the model to be sent to the API
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * convert the model to an array
     * @return array
     */
    public function toArray()
    {
        $values = [];

        foreach ($this->_allowedProperties as $key) {
            $methodName = 'get' . ucfirst($key);

            if (method_exists($this, $methodName)) {
                $values[$key] = $this->$methodName();
            } elseif (array_key_exists($key, $this->_properties)) {
                $values[$key] = $this->_properties[$key];
            }

            if (!empty($values[$key]) && ($values[$key] instanceof ModelAbstract || $values[$key] instanceof ModelRowsetAbstract)) {
                $values[$key] = $values[$key]->toArray();
            }
        }

        return $values;
    }

}
