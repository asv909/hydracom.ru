<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * Description of WelcomeTest
 *
 * @author asv
 */
class WelcomeTest extends WebTestCase {
    
    function setUp() {
        $this->setBrowser("*googlechrome");
        $this->setBrowserUrl("http://hydracom.ru/");
    }

    function testMyTestCase() {
        $this->open("");
        $this->assertTextPresent('Welcome');
    }
}
?>