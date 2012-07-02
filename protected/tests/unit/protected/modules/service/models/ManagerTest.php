<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Manager.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ManagerIdentity.php';
require_once dirname(__FILE__) . '/../../../../../../components/Helpers.php';

class ManagerTest extends CDbTestCase {

    private $manager;
    private $valid_data = array(
        'username' => 'asv909',
        'password' => 'ErTrd-2007',
        'rememberMe' => FALSE,
        'verifyCode' => 'dolotut'
        );
    
    protected function setUp() {
        parent::setUp();
    }

    protected function tearDown() {
    }

    public function testTableNameIsExist() 
    {
        $this->manager = new Manager;
        $this->assertEquals($this->manager->tableName(),$this->manager->tableSchema->name);
    }

    public function testAutenticateAfterWrongValidation()
    {
        $this->manager = new Manager;
        $this->manager->addError('password', "Необходимо заполнить поле!");
        $this->assertFalse($this->manager->authenticate());
    }
    
        public function testAuthenticateWithUnknownUsername() 
    {
        $this->manager = new Manager;
        $username = $this->manager->username;
        $this->manager->username = "unknown";
        $this->assertFalse($this->manager->authenticate());
        $this->manager->username = $username;
    }
    
    public function testAuthenticate() 
    {
        // for valid data
        $this->manager = new Manager;
        $this->manager->attributes = $this->valid_data;
        $this->assertTrue($this->manager->authenticate());
        // for wrong password having length > 12 char so that 1st condition if(!$this->hasErrors()) would FALSE
        $password = $this->manager->password;
        $this->manager->password = "wrong_password";
        $this->assertFalse($this->manager->authenticate());
        $this->manager->password = $password;
        // for wrong password < 12 char
        $this->valid_data['password'] = "wrong_pass";
        $this->manager = new Manager;
        $this->manager->attributes = $this->valid_data;
        $this->assertFalse($this->manager->authenticate());
    }
    
    public function testLogin() 
    {
        $this->manager = new Manager;
        $this->manager->attributes = $this->valid_data;
        $this->assertNotEmpty($this->manager->login());
    }
    
    public function testAttributeLabels() 
    {
        $this->manager = new Manager;
        $this->assertType('array', $this->manager->attributeLabels());
        $this->assertNotEmpty($this->manager->attributeLabels());
        $attr_labels = $this->manager->attributeLabels();
        $this->assertEquals('Логин', $attr_labels['username']);
        $this->assertEquals('Пароль', $attr_labels['password']);
    }
    
    public function testRules() 
    {
        $this->manager = new Manager;
        $this->assertType('array', $this->manager->rules());
        $this->assertNotEmpty($this->manager->rules());        
    }
    
    public function testModel()
    {
        $this->manager = new Manager;
        $this->assertNotEmpty($this->manager->model());
    }
}