<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ServiceController.php';

/**
 * Test class for Controller of service module
 */
class ServiceControllerTest extends CTestCase 
{
    public $controller;
    public $layout_name = 'main'; //this value must be equivalent to $layout within /../../../../../../modules/service/components/Controller.php
    
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

    public function testLayoutFileExists() 
    {
        $this->controller = new Controller('manager', 'service');
        $this->assertEquals($this->layout_name, $this->controller->layout, "Имя используемого по умолчанию шаблона не совпадает с 'main'");
        $this->assertTrue(file_exists(dirname(__FILE__) . '/../../../../../../modules/service/views/layouts/' . $this->layout_name . '.php'), "Файл шаблона, используемого по умолчанию, не обнаружен");
    }
}
?>