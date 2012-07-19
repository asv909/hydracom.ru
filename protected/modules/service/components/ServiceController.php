<?php
/**
 * ServiceController class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright © 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * <var>ServiceController</var> is a component of the service module and maintains
 *  a base controller class.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: ServiceController.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class ServiceController extends CController 
{
    /**
     * @var string $layout the default layout for the controller view. 
     */
    public $layout = '/layouts/column2';
    
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
}