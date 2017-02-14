<?php

namespace Automile\Sdk\Storage;


/**
 * The interface should be implemented by all objects using the storage component
 * @package Automile\Sdk\Storage
 */
interface StorableInterface
{

    /**
     * key-value pairs of data to be stored
     * @return array
     */
    public function getStorableData();

    /**
     * create an object from the stored data
     * @param array $data key-value pairs that were previously stored
     * @return StorableInterface
     */
    public static function restoreFromStorage(array $data);

}