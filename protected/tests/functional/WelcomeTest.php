<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class WelcomeTest extends WebTestCase 
{
    function setUp() {
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    function testMyTestCase() 
    {
        $this->open("");
        $this->assertTextPresent('Welcome');
    }
}