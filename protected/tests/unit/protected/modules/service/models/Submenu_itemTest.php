<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Submenu_item.php';

class Submenu_itemTest extends CDbTestCase 
{
    private $_submenuItem;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_submenuItem = new Submenu_item;
        $this->assertEquals($this->_submenuItem->tableName(),
                            $this->_submenuItem->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_submenuItem = new Submenu_item;
        $this->assertNotEmpty($this->_submenuItem->model());
    }
    
    public function testRelations()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
}