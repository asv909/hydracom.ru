<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Org.php';

class OrgTest extends CDbTestCase 
{
    private $_org;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_org = new Org;
        $this->assertEquals($this->_org->tableName(),
                            $this->_org->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_org = new Org;
        $this->assertNotEmpty($this->_org->model());
    }

    public function testRules()
    {
        $this->_org = new Org;
        $this->assertNotEmpty($this->_org->rules());
    }

    public function testAttributeLabels()
    {
        $this->_org = new Org;
        $this->assertNotEmpty($this->_org->attributeLabels());
    }

    public function testSearch()
    {
        $this->_org = new Org;
        $this->assertNotEmpty($this->_org->search());
    }
}