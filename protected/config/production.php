<?php

// This is the Web application configuration for development. Any 
// CWebApplication properties configured here will be replace the same 
// from main.php 
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=???.???.???.???;dbname=hydracom',
                'emulatePrepare'   => true,
                'username'         => '******',
                'password'         => '************',
                'charset'          => 'utf8',
            ),
        ),
    )
);