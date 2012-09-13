<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/components/Mainmenu.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Menu_item.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Submenu_item.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Url.php';

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Manager.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/components/ManagerIdentity.php';
require_once dirname(__FILE__) . '/../../../../../../modules/service/models/LoginForm.php';

/**
 * Test class for Mainmenu.
 * Generated by PHPUnit on 2012-08-30 at 13:22:51.
 */
class MainmenuTest extends CDbTestCase 
{
    private $_loginForm;
    private $valid_data = array(
        'username'   => 'asv909',
        'password'   => 'ErTrd-2007',
        'rememberMe' => FALSE,
        'verifyCode' => 'dolotut'
    );
    
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}

    /**
     * @todo Implement testGetConf().
     */
    public function testGetConf()
    {
        $result = Mainmenu::getConf('order');
        $this->assertNotNull($result);
        $result = Mainmenu::getConf('measure');
        $this->assertNotNull($result);
        $this->assertArrayHasKey('6', $result);
    }
}