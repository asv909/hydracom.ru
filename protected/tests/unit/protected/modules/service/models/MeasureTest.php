<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Measure.php';

class MeasureTest extends CDbTestCase 
{
    private $_measure;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_measure = new Measure;
        $this->assertEquals($this->_measure->tableName(),
                            $this->_measure->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_measure = new Measure;
        $this->assertNotEmpty($this->_measure->model());
    }

    public function testRules()
    {
        $this->_measure = new Measure;
        $this->assertNotEmpty($this->_measure->rules());
    }

    public function testAttributeLabels()
    {
        $this->_measure = new Measure;
        $this->assertNotEmpty($this->_measure->attributeLabels());
    }

    public function testSearch()
    {
        $this->_measure = new Measure;
        $this->assertNotEmpty($this->_measure->search());
    }
}