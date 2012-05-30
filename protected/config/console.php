<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'HYDRACOM Console Application',

    'components'=>array(
        'db'=>array(
            'connectionString'=>'mysql:host=localhost;dbname=hydracom',//test',//hydracom',
            'emulatePrepare'=>true,
            'username'=>'root',
            'password'=>'ertrd2007',
            'charset'=>'utf8',
        ),
    ),
);