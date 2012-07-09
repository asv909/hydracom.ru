<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Manager.php';

class ManagerTest extends CDbTestCase {

    private $manager;
    private $_identity;
    
    private $valid_data = array(
        'username'   => 'asv909',
        'password'   => 'ErTrd-2007',
        'rememberMe' => FALSE,
        'verifyCode' => 'dolotut'
        );
    
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    /**
     * @group manager
     */
    public function testTableNameIsExist()
    {
        $this->manager = new Manager;
        $this->assertEquals($this->manager->tableName(), $this->manager->tableSchema->name);
    }
    
    /**
     * @group manager
     */    
    public function testModel()
    {
        $this->manager = new Manager;
        $this->assertNotEmpty($this->manager->model());
    }
}