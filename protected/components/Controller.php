<?php
/**
 * Controller class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>Controller</var> is common component of the main application and 
 * maintains a base controller class.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Controller.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class Controller extends CController 
{
    /**
     * @var string $layout the default layout for the controller view. 
     */
    public $layout = 'main';
}