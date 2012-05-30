<?php

// This is the Web application configuration for development. Any 
// CWebApplication properties configured here will be replace the same 
// from main.php 
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'components'=>array(
            'db'=>array(
                'connectionString'=>'mysql:host=localhost;dbname=hydracom',
                'emulatePrepare'=>true,
                'username'=>'root',
                'password'=>'ertrd2007',
                'charset'=>'utf8',
            ),
        ),
        'params' => array(
            'SeleniumTestsEnvironment' => '/index-test.php',
            'param' => '249?6H3xyz!',
        ),
    )
);