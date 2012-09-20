<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/Mainmenu.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Menu_item.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Submenu_item.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Url.php';

/**
 * Test class for Mainmenu.
 * Generated by PHPUnit on 2012-08-30 at 13:22:51.
 */
class MainmenuTest extends CDbTestCase 
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}

    public function testGetConf()
    {
        $result = Mainmenu::getConf('order');
        $this->assertNotNull($result);
        $result = Mainmenu::getConf('measure');
        $this->assertNotNull($result);
        $this->assertArrayHasKey('6', $result);
    }
}