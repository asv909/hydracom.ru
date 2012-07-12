<?php
/**
 * main.php file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>main.php</var> is main configuration of application HYDRACOM.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: main.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */

/**
 * @return array main configuration of application
 */
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'HYDRACOM',

    'preload'  => array('log'),

    'import'   => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(
        'service',
    ),

    'components' => array(
        'request' => array(
            'enableCsrfValidation'   => true,
            'enableCookieValidation' => true,
        ),
        'user' => array(
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat'      => 'path',
            'showScriptName' => false,
            'rules'          => array(
                '/'       => 'home/index',
                'manager' => 'service/manager/index',
                'login'   => 'service/manager/login',
                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
            ),
        ),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        'test' => TRUE,
    ),        
);