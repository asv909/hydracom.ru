<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class AdminPanelTest extends WebTestCase 
{
    function setUp()
    {
        parent::setUp();
        $this->setTimeout(1);
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    function testAdminPanelMenu()
    {
        $this->open("service");
        $this->assertElementContainsText('css=a[href="service/admin/lookup/id/brand"]',
                                        'Производители');
    }
}
?>