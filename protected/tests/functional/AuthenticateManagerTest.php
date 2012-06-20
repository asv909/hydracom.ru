<?php
/**
 * Description of ServiceModule
 *
 * @author asv
 */
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * Description of AuthenticateManagerTest
 *
 * @author asv
 */
class AuthenticateManagerTest extends WebTestCase 
{
    function setUp() 
    {
        parent::setUp();
        $this->setTimeout(2);
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    /**
     * Description of testSuccessfulLogin
     * Openning page of services section, checking that login form is present, 
     * filling form with valid data, clicking button and if welcome 
     * message is present then all is ok
     */
    function testSuccessfulLogin() 
    {
        $this->open("manager");
        $this->assertElementPresent('css=#login_form');
        $this->type('css=#Manager_username','asv909');
        $this->type('css=#Manager_password','ErTrd-2007');
        $this->click('css=#Manager_rememberMe');
        $this->type('css=#Manager_verifyCode', 'dolotut');
        $this->clickAndWait('css=#login_manager_button');
        $this->assertTextPresent('Здравствуйте Сергей Владимирович!');
    }
    
    /**
     * Description of testUnsuccessfulLogin
     * Openning page of services section, checking that login form is present, 
     * clicking button and if login form is present again then all is ok
     */
    public function testUnsuccessfulLogin() 
    {
        $this->open('manager');
        $this->clickAndWait('css=#login_manager_button');
        $this->assertElementPresent('css=#login_form');
    }
    
    /**
     *
     * 
     * 
     */ 
    public function testUsernameOrPasswordIsEmpty() 
    {
        $this->open('manager');
        $this->focus('css=#Manager_username');
        $this->type('css=#Manager_username','');
        $this->focus('css=#Manager_password');
        $this->type('css=#Manager_password','');
        $this->focus('css=#Manager_username');
        sleep(1);
        $this->assertTextPresent('Необходимо заполнить поле Логин!');
        $this->assertTextPresent('Необходимо заполнить поле Пароль!');
    }
    
    /**
     *
     * 
     * 
     */ 
    public function testCaptchaDoesNotMatch() 
    {
        $this->open('manager');
        $this->type('css=#Manager_username','asv909');
        $this->type('css=#Manager_password','ErTrd-2007');
        $this->type('css=#Manager_verifyCode', 'wrongcode');
        $this->clickAndWait('css=#login_manager_button');
        $this->assertTextPresent('Код защиты указан не верно!');
    }    
}
?>