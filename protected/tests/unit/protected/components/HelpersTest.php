<?php

require_once dirname(__FILE__) . '/../../../../components/Helpers.php';

/**
 * Test class for Helpers.
 * Generated by PHPUnit on 2012-06-18 at 09:56:52.
 */
class HelpersTest extends CTestCase 
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() 
    {
        parent::setUp();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {}

    /**
     * @todo Implement testCreateUrl().
     */
    public function testCreateUrl() 
    {
        $resource_name = "/test";
        $expected = "/index-test.php/test";
        $this->assertSame($expected, Helpers::createUrl($resource_name));
    }

    /**
     * @todo Implement testCreateHash().
     */
    public function testCreateHash() 
    {
        $expected = "cf798d919ced9e86f70814173745990e97b09bbd"; // reference hash of $username and $password that you see below
        $username = "asv909";
        $password = "ErTrd-2007";
        $salt = "4fc5c61db89199.64581532"; // reference salt of $username and $password that you see above
        $suffix = "249?6H3xyz!"; // this value must be equivalent to $suffix within /../../../../../../modules/service/ServiceModule.php
        $this->assertSame($expected, Helpers::createHash($username, $password, $salt, $suffix));
    }

    /**
     * @todo Implement testRestrictNumberOfAttempts().
     */
    public function testRestrictNumberOfAttempts() 
    {
        $num_of_attempts = 1;
        $timeout = 5;
        $this->assertFalse(Helpers::restrictNumberOfAttempts($num_of_attempts, $timeout));
        $this->assertTrue(Helpers::restrictNumberOfAttempts($num_of_attempts, $timeout));
        sleep($timeout+1);
        $this->assertFalse(Helpers::restrictNumberOfAttempts($num_of_attempts, $timeout));
    }
}
?>