<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class AdminPanelTest extends WebTestCase 
{
    public $fixtures = array(
        'measure' => ':measure',
    );
    
    function setUp()
    {
        parent::setUp();
        $this->setTimeout(3);
        $this->setBrowser('*googlechrome');
        $this->setBrowserUrl('http://hydracom.ru/');
    }

    function testIndexAction()
    {
        $this->open('/index-test.php/service/admin/index');
        $this->assertTextPresent('Здравствуйте уважаемый Тестер!');
        $this->assertElementContainsText('css=a[href="/service/admin/review/item/org"]',
                                         'Организационно- правовые формы');
    }

    function testReviwAction()
    {
        $this->open('/index-test.php/service/admin/review/item/city');
        $this->assertElementContainsText('css=a[href="/service/admin/edit/item/city/id/1"]',
                                        'Выборг');
    }
    
    function testEditAction()
    {   
        $this->open('/index-test.php/service/admin/edit/item/measure/id/1');
        $this->assertElementValueEquals('css=input[id="Measure_name"]', 'м');
        $this->type('css=#Measure_name', 'метр');
        $this->clickAndWait('css=#edit_item');
        $this->assertElementContainsText('css=a[href="/service/admin/edit/item/measure/id/1"]',
                                         'метр');
    }

    function testAddNewItem()
    {
        $this->open('/index-test.php/service/admin/add_new/item/measure');
        $this->verifyElementPresent('css=#Measure_name');
        $this->type('css=#Measure_name', 'тест');
        $this->clickAndWait('css=#add_new_item');
        $this->assertTextPresent('тест');
    }
}