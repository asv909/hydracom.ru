<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Region.php';

class RegionTest extends CDbTestCase 
{
    private $_region;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_region = new Region;
        $this->assertEquals($this->_region->tableName(),
                            $this->_region->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_region = new Region;
        $this->assertNotEmpty($this->_region->model());
    }

    public function testRules()
    {
        $this->_region = new Region;
        $this->assertNotEmpty($this->_region->rules());
    }

    public function testAttributeLabels()
    {
        $this->_region = new Region;
        $this->assertNotEmpty($this->_region->attributeLabels());
    }

    public function testSearch()
    {
        $this->_region = new Region;
        $this->assertNotEmpty($this->_region->search());
    }
}