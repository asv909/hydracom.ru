<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class AuthenticateManagerTest extends WebTestCase 
{
    function setUp() {
        parent::setUp();
        $this->setTimeout(5);
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

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
    
    public function testUnsuccessfulLogin() 
    {
        $this->open('manager');
        $this->clickAndWait('css=#login_manager_button');
        $this->assertElementPresent('css=#login_form');
    }
    
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