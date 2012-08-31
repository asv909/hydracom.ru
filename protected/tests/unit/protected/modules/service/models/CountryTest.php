<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Country.php';

class CountryTest extends CDbTestCase 
{
    private $_country;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_country = new Country;
        $this->assertEquals($this->_country->tableName(),
                            $this->_country->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_country = new Country;
        $this->assertNotEmpty($this->_country->model());
    }

    public function testRules()
    {
        $this->_country = new Country;
        $this->assertNotEmpty($this->_country->rules());
    }

    public function testAttributeLabels()
    {
        $this->_country = new Country;
        $this->assertNotEmpty($this->_country->attributeLabels());
    }

    public function testSearch()
    {
        $this->_country = new Country;
        $this->assertNotEmpty($this->_country->search());
    }
}