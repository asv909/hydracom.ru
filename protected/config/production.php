<?php
/**
 * production.php file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>production.php</var> is additional configuration of application 
 * HYDRACOM for production mode.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: production.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */

/**
 * @return array is merge data from the main.php with own
 */ 
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