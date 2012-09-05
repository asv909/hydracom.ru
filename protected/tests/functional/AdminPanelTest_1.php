<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class AdminPanelTest extends WebTestCase 
{
    function setUp()
    {
        parent::setUp();
        $this->setTimeout(3);
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    function testAdminPanelMenu()
    {
        $this->open("service/admin/index");
        $this->type('css=#LoginForm_username','asv909');
        $this->type('css=#LoginForm_password','ErTrd-2007');
        $this->click('css=#LoginForm_rememberMe');
        $this->type('css=#LoginForm_verifyCode', 'dolotut');
        $this->clickAndWait('css=#login_manager_button');
        $this->assertTextPresent('Здравствуйте Сергей Владимирович!');
        $this->assertElementContainsText('css=a[href="/service/admin/view/item/org"]', 'Организационно- правовые формы');
        $this->clickAndWait('css=a[href="/service/admin/view/item/org"]');
        $this->assertTextPresent('ЗАО');
        $this->assertElementContainsText('css=a[href="/service/admin/look/item/org/id/2"]', '2');
    }
}
?>