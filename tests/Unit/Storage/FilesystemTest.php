<?php

namespace Automile\Sdk\Tests\Unit\Storage;

use Automile\Sdk\Storage\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{

    public function testSaveRead()
    {
        $data = [
            'var1' => 'value1',
            'var2' => 'value2',
            'var3' => 'value3'
        ];

        $storable = new StorableMock($data);

        $this->assertEquals($data, $storable->getStorableData());

        $filePath = tempnam(sys_get_temp_dir(), 'storagetest');

        $storage = (new Filesystem())
            ->setFilePath($filePath);

        $storage->save($storable);

        $storableRestored = $storage->restore(StorableMock::class);

        $this->assertEquals($data, $storableRestored->getStorableData());
    }

}
