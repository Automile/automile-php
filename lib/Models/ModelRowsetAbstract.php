<?php

namespace Automile\Sdk\Models;

/**
 * Abstract class to be inherited by all rowset models
 * @package Automile\Sdk\Models
 */
abstract class ModelRowsetAbstract implements \Iterator, \ArrayAccess
{

    /**
     * @var array
     */
    private $_models = [];

    /**
     * @var int
     */
    private $_position = 0;

    /**
     * Model Rowset constructor
     * @param array|object $rows contains arrays or objects to initialize models for
     */
    public function __construct($rows = [])
    {
        foreach ($rows as $row) {
            $this->push($this->getModel($row));
        }
    }

    function rewind()
    {
        $this->_position = 0;
    }

    function current()
    {
        return $this->offsetGet($this->_position);
    }

    function key()
    {
        return $this->_position;
    }

    function next()
    {
        $this->_position++;
    }

    function valid()
    {
        return $this->offsetExists($this->_position);
    }

    public function offsetSet($offset, $model)
    {
        if (!$model instanceof ModelAbstract) {
            throw new ModelException('Only models can be added into the rowset');
        }

        $this->push($model, $offset);
    }

    public function offsetExists($offset) {
        return isset($this->_models[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->_models[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->_models[$offset]) ? $this->_models[$offset] : null;
    }

    /**
     * @param ModelAbstract $model
     * @param null $offset
     * @return ModelRowsetAbstract
     * @throws ModelException
     */
    public function push(ModelAbstract $model, $offset = null)
    {
        if (is_numeric($offset)) {
            $this->_models[$offset] = $model;
        } elseif ($offset) {
            throw new ModelException("Invalid rowset offset: '{$offset}', only numbers are allowed");
        } else {
            $this->_models[] = $model;
        }

        return $this;
    }

    /**
     * Create new model to be added into the rowset
     * @param array|object $properties
     * @return ModelAbstract
     */
    abstract public function getModel($properties);

}
