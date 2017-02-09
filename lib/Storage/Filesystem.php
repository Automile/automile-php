<?php

namespace Automile\Sdk\Storage;


class Filesystem implements StorageInterface
{

    /**
     * @var string
     */
    private $_path;

    /**
     * @param string $path path to the file
     * @return Filesystem
     */
    public function setFilePath($path)
    {
        $this->_path = $path;
        return $this;
    }

    /**
     * @param StorableInterface $storable
     * @return bool
     */
    public function save(StorableInterface $storable)
    {
        $data = $storable->getStorableData();
        if (is_array($data) && count($data)) {
            return $this->_saveData($data);
        }

        return false;
    }

    /**
     * @param string $storableClass class name of a storable implementation
     * @return StorableInterface|null
     */
    public function restore($storable)
    {
        $data = $this->_loadData();
        if (!$data) {
            return null;
        }

        if (!class_exists($storable)) {
            throw new StorageException("Class '{$storable}' cannot be found");
        }
        if (!method_exists($storable, 'restoreFromStorage')) {
            throw new StorageException("Class '{$storable}' should implement 'Storable' interface");
        }
        return $storable::restoreFromStorage($data);
    }

    /**
     * @param array $data
     * @return bool
     * @throws StorageException
     */
    private function _saveData(array $data)
    {
        if (!$this->_path) {
            throw new StorageException('File path is required');
        }

        $data = json_encode($data);
        if (!$data) {
            throw new StorageException("The data cannot be correct encoded");
        }

        $result = file_put_contents($this->_path, $data, LOCK_EX);
        if (false === $result) {
            throw new StorageException("Could not save data into the file '{$this->_path}'");
        }

        return false !== $result;
    }

    /**
     * @return array
     * @throws StorageException
     */
    private function _loadData()
    {
        if (!$this->_path) {
            throw new StorageException('File path is required');
        }

        if (!file_exists($this->_path)) {
            return [];
        }

        $data = file_get_contents($this->_path);
        if (false === $data) {
            throw new StorageException("Could not read data from the file '{$this->_path}'");
        }

        if (!$data) {
            return [];
        }

        $data = json_decode($data, true);
        if (!count($data)) {
            throw new StorageException("Count not encode content of the file '{$this->_path}'");
        }

        return $data;
    }

}