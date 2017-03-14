<?php

namespace Automile\Sdk\Models;

/**
 * Abstract class to be inherited by all rowset models
 * utilizes deferred object instantiation
 */
abstract class ModelRowsetAbstract implements \Iterator, \ArrayAccess, \Countable
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
        $this->pushMany($rows);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_models);
    }

    /**
     * set the internal pointer to the first element
     * @see \Iterator
     */
    function rewind()
    {
        $this->_position = 0;
    }

    /**
     * retrieve the current element
     * @see \Iterator
     * @return ModelAbstract
     */
    function current()
    {
        return $this->offsetGet($this->_position);
    }

    /**
     * retrieve the internal pointer position
     * @see \Iterator
     * @return int
     */
    function key()
    {
        return $this->_position;
    }

    /**
     * move pointer to the next element
     * @see \Iterator
     */
    function next()
    {
        $this->_position++;
    }

    /**
     * determine whether the current pointer position is valid
     * @see \Iterator
     * @return bool
     */
    function valid()
    {
        return $this->offsetExists($this->_position);
    }

    /**
     * assign an element to the specified position in the rowset
     * @param int $offset
     * @param array|object $model
     * @throws ModelException
     * @see \ArrayAccess
     */
    public function offsetSet($offset, $model)
    {
        if (!$model instanceof ModelAbstract) {
            throw new ModelException('Only models can be added into the rowset');
        }

        $this->push($model, $offset);
    }

    /**
     * determine whether an element exists under specified offset
     * @param int $offset
     * @return bool
     * @see \ArrayAccess
     */
    public function offsetExists($offset) {
        return isset($this->_models[$offset]);
    }

    /**
     * unset an element under specified offset
     * @param mixed $offset
     * @see \ArrayAccess
     */
    public function offsetUnset($offset) {
        unset($this->_models[$offset]);
    }

    /**
     * retrieve an element under specified offset
     * the method uses lazy loading
     * if the element hasn't been wrapped into a Model object yet, the model instantiation will be performed
     *
     * @param int $offset
     * @return ModelAbstract|null
     * @see \ArrayAccess
     */
    public function offsetGet($offset) {
        if (isset($this->_models[$offset])) {
           if (!is_object($this->_models[$offset]) || !$this->_models[$offset] instanceof ModelAbstract) {
               $this->_models[$offset] = $this->getModel($this->_models[$offset]);
           }

           return $this->_models[$offset];
        }

        return null;
    }

    /**
     * push an element into the rowset
     * @param array|object $row
     * @param int $offset if missing, the element is pushed into the end of the rowset
     * @return ModelRowsetAbstract
     * @throws ModelException
     */
    public function push($row, $offset = null)
    {
        if (is_numeric($offset)) {
            $this->_models[$offset] = $row;
        } elseif ($offset) {
            throw new ModelException("Invalid rowset offset: '{$offset}', only numbers are allowed");
        } else {
            $this->_models[] = $row;
        }

        return $this;
    }

    /**
     * convert the rowset and all its models to a multi-dimensional array
     * @return array
     */
    public function toArray()
    {
        $values = [];
        if (count($this->_models)) {
            foreach ($this as $model) {
                $values[] = $model->toArray();
            }
        }

        return $values;
    }

    /**
     * @param array|object $rows contains arrays or objects to initialize models for
     * @return ModelRowsetAbstract
     */
    public function pushMany($rows)
    {
        if ($rows) {
            foreach ($rows as $row) {
                $this->push($row);
            }
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
