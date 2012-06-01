<?php

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'components' => array(
            'fixture' => array(
		'class' => 'system.test.CDbFixtureManager',
                ),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=test',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'ertrd2007',
                'charset' => 'utf8',
                ),
            ),
        'params' => array(
            'param' => '249?6H3xyz!',
            'testenv' => '/index-test.php',
            ),
        )
    );
