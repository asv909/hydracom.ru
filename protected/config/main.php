<?php
/**
 * Description of main.php - main configuration of application
 *
 * @author asv
 */
return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'HYDRACOM',

    'preload' => array('log'),

    'import' => array(
        'application.models.*',
        'application.components.*',
        ),

    'modules' => array(
        'service',
        ),

    'components' => array(
        'request' => array(
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true,
            ),
        'user' => array(
            'allowAutoLogin' => true,
            ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '/' => 'home/index',
                'manager' => 'service/manager/index',
                'manager_login' => 'service/manager/login',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    ),
                ),
            ),
        ),
    'params' => array(
        'testenv' => '',
        'test' => TRUE,
        ),        
    );
?>