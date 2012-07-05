<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ServiceController.php';

/**
 * Test class for ServiceController component of service module
 */
class ServiceControllerTest extends CTestCase 
{
    private $_controller;
    
    //this value must be equivalent to $layout within /../../../../../../modules/service/components/ServiceController.php
    private $_layoutName = 'main';
    
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}

    /**
     * @group manager
     */    
    public function testLayoutFileExists() 
    {
        $this->_controller = new Controller('test');
        $this->assertEquals($this->_layoutName,
                            $this->_controller->layout,
                            "Имя используемого по умолчанию шаблона не совпадает с 'main'");
        $this->assertFileExists(dirname(__FILE__)
                                . '/../../../../../../modules/service/views/layouts/'
                                . $this->_layoutName
                                . '.php',
                                'Файл шаблона, используемого по умолчанию, не обнаружен');
    }
}