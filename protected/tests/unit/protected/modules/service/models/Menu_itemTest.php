<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Menu_item.php';

class Menu_itemTest extends CDbTestCase 
{
    private $_menuItem;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_menuItem = new Menu_item;
        $this->assertEquals($this->_menuItem->tableName(),
                            $this->_menuItem->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_menuItem = new Menu_item;
        $this->assertNotEmpty($this->_menuItem->model());
    }
        
    public function testRelations()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
}