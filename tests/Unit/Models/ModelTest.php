<?php

namespace Automile\Sdk\Tests\Unit\Models;

use Automile\Sdk\Models\ModelAbstract;
use PHPUnit\Framework\TestCase;

/**
 * Base model methods
 */
class ModelTest extends TestCase
{

    private $_mockValues = [
        'Property1' => 'val1',
        'Property2' => 'val2',
        'Property3' => 'val3',
        'Property4' => 'val4'
    ];

    /**
     * @return ModelMock
     */
    public function testProperties()
    {
        $model = new ModelMock([
            'Property1' => $this->_mockValues['Property1'],
            'Property2' => $this->_mockValues['Property2'],
            'Property4' => $this->_mockValues['Property4']
        ]);

        $this->assertInstanceOf(ModelAbstract::class, $model);

        $this->assertInstanceOf(ModelAbstract::class, $model->setProperty3($this->_mockValues['Property3']));

        $this->_mockValues['Property4'] .= '-setter-getter';

        $this->assertEquals($this->_mockValues['Property1'], $model->getProperty1());
        $this->assertEquals($this->_mockValues['Property2'], $model->getProperty2());
        $this->assertEquals($this->_mockValues['Property3'], $model->getProperty3());

        return $model;
    }

    /**
     * @depends testProperties
     * @param ModelMock $model
     */
    public function testJson(ModelMock $model)
    {
        $mockValues = $this->_mockValues;
        $mockValues['Property4'] .= '-setter-getter';

        $this->assertEquals($mockValues, $model->toArray());
        $this->assertEquals(json_encode($mockValues), $model->toJson());

        $this->assertEquals($mockValues, (new ModelMock())->reset($this->_mockValues)->toArray());
    }

}
