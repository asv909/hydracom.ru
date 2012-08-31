<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Brand.php';

class BrandTest extends CDbTestCase 
{
    private $_brand;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_brand = new Brand;
        $this->assertEquals($this->_brand->tableName(),
                            $this->_brand->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_brand = new Brand;
        $this->assertNotEmpty($this->_brand->model());
    }
    
    public function testRules()
    {
        $this->_brand = new Brand;
        $this->assertNotEmpty($this->_brand->rules());
    }

    public function testAttributeLabels()
    {
        $this->_brand = new Brand;
        $this->assertNotEmpty($this->_brand->attributeLabels());
    }

    public function testSearch()
    {
        $this->_brand = new Brand;
        $this->assertNotEmpty($this->_brand->search());
    }
}