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
        $this->setTimeout(5);
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    function testSuccessfulLoginCase() 
    {
        $this->open("manager");
        $this->assertElementPresent('css=#login_form');
        $this->type('css=#Manager_username','asv909');
        $this->type('css=#Manager_password','ErTrd-2007');
        $this->click('css=#Manager_rememberMe');
   //     $this->click('css=#Manager_verifyCode', CCaptchaAction->getVerifyCode());
        $this->clickAndWait('css=#login_manager_button');
        $this->assertTextPresent('Здравствуйте Сергей Владимирович!');
    }
}