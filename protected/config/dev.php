<?php
/**
 * Description of dev.php - development configuration of application
 *
 * @author asv
 */
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=hydracom',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'ertrd2007',
                'charset' => 'utf8',
                ),
            ),
        'params' => array(
//            'param' => '249?6H3xyz!',
            'testenv' => '',
            ),
        )
    );