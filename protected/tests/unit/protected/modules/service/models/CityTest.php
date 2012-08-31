<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/City.php';

class CityTest extends CDbTestCase 
{
    private $_city;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_city = new City;
        $this->assertEquals($this->_city->tableName(),
                            $this->_city->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_city = new City;
        $this->assertNotEmpty($this->_city->model());
    }

    public function testRules()
    {
        $this->_city = new City;
        $this->assertNotEmpty($this->_city->rules());
    }

    public function testAttributeLabels()
    {
        $this->_city = new City;
        $this->assertNotEmpty($this->_city->attributeLabels());
    }

    public function testSearch()
    {
        $this->_city = new City;
        $this->assertNotEmpty($this->_city->search());
    }
}