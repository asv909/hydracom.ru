<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ManagerIdentity.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Manager.php';
require_once dirname(__FILE__) . '/../../../../../../components/Helpers.php';

/**
 * Test class for ManagerIdentity.
 * Generated by PHPUnit on 2012-06-15 at 13:28:22.
 */
class ManagerIdentityTest extends CTestCase 
{
    public $valid_data = array(
        'username' => "asv909",
        'password' => "ErTrd-2007",
    );

    private $suffix = "249?6H3xyz!"; // this value must be equivalent to $suffix within /../../../../../../modules/service/ServiceModule.php
    private $record;
    private $hash;


    /**
     * @var ManagerIdentity
     */
    protected $_identity;

    protected function setUp() {
        parent::setUp();
    }

    protected function tearDown() {
    }

    /**
     * @todo Implement testAuthenticate().
     */
    public function testAuthenticate() 
    {
        $this->_identity = new ManagerIdentity($this->valid_data['username'], $this->valid_data['password']);
        $manager = new Manager;
        $this->record = $manager->findByAttributes(array('login' => $this->_identity->username));
        $this->_identity->setRecord($this->record);
        $this->_identity->setHash(Helpers::createHash($this->valid_data['username'], $this->valid_data['password'], $this->record->salt, $this->suffix));
        
        // with valid data
        $this->assertTrue($this->_identity->authenticate());
        
        // test getID function
        $this->assertTrue($this->_identity->getId()!==NULL);
        
        // with invalid username
        $username = $this->_identity->username;
        $this->_identity->username = NULL;
        $this->assertFalse($this->_identity->authenticate());
        $this->_identity->username = $username;

        // with invalid password
        $password = $this->_identity->password;
        $this->_identity->password = NULL;
        $this->assertFalse($this->_identity->authenticate());
        $this->_identity->password = $password;
        
        // with unknown username
        $record = $this->record;
        $this->_identity->username = "unknown";
        $this->record = $manager->findByAttributes(array('login' => $this->_identity->username));
        $this->_identity->setRecord($this->record);
        $this->assertFalse($this->_identity->authenticate());
        $this->record = $record;
        $this->_identity->setRecord($this->record);
        
        // with wrong password
        $valid_password = $this->valid_data['password'];
        $this->valid_data['password'] = "wrong_password";
        $this->_identity->setHash(Helpers::createHash($this->valid_data['username'], $this->valid_data['password'], $this->record->salt, $this->suffix));
        $this->assertFalse($this->_identity->authenticate());
        $this->valid_data['password'] = $valid_password;
    }
}
?>