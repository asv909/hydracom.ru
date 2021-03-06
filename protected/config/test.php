<?php
/**
 * Description of test.php - test configuration of application
 *
 * @author asv
 */
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'fixture' => array(
                'class' => 'system.test.CDbFixtureManager',
            ),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=test',
                'emulatePrepare'   => true,
                'username'         => 'root',
                'password'         => 'ertrd2007',
                'charset'          => 'utf8',
            ),
        ),
        'params' => array(
            'testenv' => '/index-test.php',
        ),
    )
);