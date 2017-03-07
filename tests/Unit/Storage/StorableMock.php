<?php

namespace Automile\Sdk\Tests\Unit\Storage;

use Automile\Sdk\Storage\StorableInterface;

class StorableMock implements StorableInterface
{

    private $_data = [];

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * key-value pairs of data to be stored
     * @return array
     */
    public function getStorableData()
    {
        return $this->_data;
    }

    /**
     * create an object from the stored data
     * @param array $data key-value pairs that were previously stored
     * @return StorableInterface
     */
    public static function restoreFromStorage(array $data)
    {
        return new self($data);
    }

}
