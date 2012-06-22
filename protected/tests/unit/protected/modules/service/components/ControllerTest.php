<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/Controller.php';

/**
 * Test class for Controller of service module
 */
class ControllerTest extends CTestCase 
{
    /**
     *
     * @var type 
     */
    private $_controller;
    private $_layoutName = 'main'; //this value must be equivalent to $layout within /../../../../../../modules/service/components/Controller.php
    
    protected function setUp() {
        parent::setUp();
    }

    protected function tearDown() {
    }
    
    /**
     * Testing that $layout are located in the Controller.php and $_layoutName is equivalent
     * Checking that file of layout exists
     */
    public function testLayoutNameAndFileExists() 
    {
        $this->_controller = new Controller('manager', 'service');
        $this->assertEquals($this->_layoutName, $this->_controller->layout, "Имя используемого по умолчанию шаблона не совпадает с 'main'");
        $this->assertTrue(file_exists(dirname(__FILE__) . '/../../../../../../modules/service/views/layouts/' . $this->_layoutName . '.php'), "Файл шаблона, используемого по умолчанию, не обнаружен");
    }
}
?>