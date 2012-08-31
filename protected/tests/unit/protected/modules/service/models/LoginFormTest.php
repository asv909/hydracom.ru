<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/LoginForm.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ManagerIdentity.php';
require_once dirname(__FILE__) . '/../../../../../../components/Helpers.php';

class LoginFormTest extends CTestCase 
{
    private $_loginForm;
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
    public function testAutenticateAfterWrongValidation()
    {
        $this->_loginForm = new LoginForm;
        $this->_loginForm->addError('password', 'Необходимо заполнить поле!');
        $this->assertFalse($this->_loginForm->authenticate());
    }
    
    /**
     * @group manager
     */
        public function testAuthenticateWithUnknownUsername()
    {
        $this->_loginForm = new LoginForm;
        $username = $this->_loginForm->username;
        $this->_loginForm->username = 'unknown';
        $this->assertFalse($this->_loginForm->authenticate());
        $this->assertEquals('Логин не зарегистрирован в системе!',
                            $this->_loginForm->getError('username'));
        $this->_loginForm->username = $username;
    }
    
    /**
     * @group manager
     */    
    public function testAuthenticate()
    {
        // for valid data
        $this->_loginForm = new LoginForm;
        $this->_loginForm->attributes = $this->valid_data;
        $this->assertTrue($this->_loginForm->authenticate());
        /* for wrong password having length > 12 char so that 1st condition 
         * if(!$this->hasErrors()) would FALSE 
         */
        $password = $this->_loginForm->password;
        $this->_loginForm->password = 'wrong_password';
        $this->assertFalse($this->_loginForm->authenticate());
        $this->_loginForm->password = $password;
        // for wrong password < 12 char
        $this->valid_data['password'] = 'wrong_pass';
        
        $this->_loginForm = new LoginForm;
        $this->_loginForm->attributes = $this->valid_data;
        $this->assertFalse($this->_loginForm->authenticate());
        $this->assertEquals('Пароль не совпадает с эталоном!',
                            $this->_loginForm->getError('password'));
    }
    
    /**
     * @group manager
     */    
    public function testLogin()
    {
        $this->_loginForm = new LoginForm;
        $this->_loginForm->attributes = $this->valid_data;
        $this->assertNotEmpty($this->_loginForm->login());
    }
    
    /**
     * @group manager
     */    
    public function testAttributeLabels()
    {
        $this->_loginForm = new LoginForm;
        $this->assertType('array', $this->_loginForm->attributeLabels());
        $this->assertNotEmpty($this->_loginForm->attributeLabels());
        $attr_labels = $this->_loginForm->attributeLabels();
        $this->assertEquals('Логин', $attr_labels['username']);
        $this->assertEquals('Пароль', $attr_labels['password']);
    }
    
    /**
     * @group manager
     */    
    public function testRules()
    {
        $this->_loginForm = new LoginForm;
        $this->assertType('array', $this->_loginForm->rules());
        $this->assertNotEmpty($this->_loginForm->rules());        
    }
}