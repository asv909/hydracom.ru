<?php
/**
 * ServiceModule class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * The <var>ServiceModule</var> class acts as a central location inside module 
 * for storing shared information .
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: ServiceModule.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class ServiceModule extends CWebModule 
{
    /**
     * @var array @restrictAuthenticate an array of key-value pairs are used to 
     * restrict authentication of managers.
     * 
     * Note, the key <var>'officeIP'</var> allows authentication only from the 
     * specified IP-address. 
     * The key <var>'timeout'</var> sets the duration of the pause between the 
     * series of attempts. 
     * The number of attempts for a series set in a key <var>'numberOfAttempts'</var>.
     */
    public $restrictAuthenticate = array(
        'officeIP'         => '127.0.0.1',
        'numberOfAttempts' => 3,
        'timeout'          => 30,
    );
    
    /**
     * @var integer $rememberTime is this time in seconds, during which will act autologin
     * 
     * Note: 43200 is result of 3600*12, where 3600 is value of seconds in one 
     * hour and 12 is value of hours for action autologin
     */
    public $rememberTime = 43200;
    
    /**
     * Sets the aliases that are used in the module. 
     */
    public function init()
    {
        $this->setImport(array(
            'service.models.*',
            'service.components.*',
        ));
    } 
}