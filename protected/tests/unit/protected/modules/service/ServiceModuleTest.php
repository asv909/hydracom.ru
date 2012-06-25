<?php

require_once dirname(__FILE__) . '/../../../../../modules/service/ServiceModule.php';

/**
 * Test class for ServiceModule.
 * Generated by PHPUnit on 2012-06-25 at 07:53:23.
 */
class ServiceModuleTest extends CTestCase 
{
    private $_serviceModule;
    
    protected function setUp() {
        parent::setUp();
    }

    protected function tearDown() {
    }

    public function testInit() 
    {
        $key_1_ = 'officeIP';
        $key_2_ = 'numberOfAttempts';
        $key_3_ = 'timeout';
        $_serviceModule = new ServiceModule('test', '');
        $this->assertArrayHasKey($key_1_, $_serviceModule->restrictAuthenticate);
        $this->assertArrayHasKey($key_2_, $_serviceModule->restrictAuthenticate);
        $this->assertArrayHasKey($key_3_, $_serviceModule->restrictAuthenticate);
    }
}