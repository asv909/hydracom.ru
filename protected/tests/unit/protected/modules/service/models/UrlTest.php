<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Url.php';

class UrlTest extends CDbTestCase 
{
    private $_url;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_url = new Url;
        $this->assertEquals($this->_url->tableName(),
                            $this->_url->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_url = new Url;
        $this->assertNotEmpty($this->_url->model());
    }
    
    public function testRelations()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
}