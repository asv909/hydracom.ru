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
    
    /**
     * @var CHttpSession $_session is instance of the CHttpSession class.
     */
    protected $_session;

    /**
     * Performs all work with the session: 
     * <ul>
     * <li><var>start</var>: start new or exist session, store action name from 
     * which the call is made Session;</li>
     * <li><var>control</var>: controls to limit the number of authentication 
     * attempts and sets the delay between the series of attempts;</li>
     * <li><var>check</var>: checks the temporary ban on attempts to authenticate
     *  is set or no;</li>
     * <li><var>unset</var>: destroys the current session;</li>
     * <li><var>default</var> this code is executed in all other cases, eg for 
     * action 'stop'</li>
     * </ul>
     * 
     * @param string $action is short name (alias) of manipulation that will be 
     * applied to the variables of the current session
     * @param array $data is the data needed to perform the action
     * @return boolean TRUE If set a restriction for the current session, or 
     * FALSE otherwise
     */
    protected function Session($action, $data=array())
    {
        $restrict = FALSE;
        if (!isset($this->_session)) {
            $this->_session = new CHttpSession;
            $this->_session->setTimeout($this->module->rememberTime);
        }
        switch ($action) {
            case 'start':
                $this->_session->open();
                break;
            case 'unset':
                $this->_session->destroy();
                break;
            /* 
             * break need only if session parameter 'restrict'='0', otherwise need execute 
             * case 'control': also
             */
            case 'check':
                if (!$this->_session->get('restrict', 0)) {
                    break;
                }
            /* 
             * break not used because the default: must be execute also
             */
            case 'control':
                $attempt_ = $this->_session->get('countOfAttempts', 0) + 1;
                if ($attempt_ >= $data['numberOfAttempts']) {
                    if ($this->_session->get('restrictTime', 0) === 0) {
                        $this->_session->add('restrictTime', time());
                        $this->_session->add('restrict', 1);
                        $restrict = TRUE;
                    } elseif ((time()-$this->_session->get('restrictTime', 0)) < $data['timeout']) {
                        $restrict = TRUE;
                    } else {
                        $this->_session->remove('restrictTime');
                        $this->_session->remove('restrict');
                        $this->_session->add('countOfAttempts', 0);
                    }
                } else {
                    $this->_session->add('countOfAttempts', $attempt_);
                }
            default:
                $this->_session->close();
        }
        return $restrict;
    }
    
    /**
     * AJAX-validates form data and returns the results to brouser in JSON format
     * 
     * @param Manager $manager current instance of the object model the Manager
     */
    protected function performAjaxValidation($loginForm)
    {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'login_form')) {
            echo CActiveForm::validate($loginForm);
            Yii::app()->end();
        }
    }

    /**
     * Checks and compares the two key security. First key stored in personal 
     * DB-record of the manager, second key stored in browsers cookie.
     * 
     * @return boolean TRUE if the both keys exist and matched or FALSE otherwise
     */
    protected function checkSecutityKey()
    {
        $id = Yii::app()->user->id;
        $skey = Yii::app()->user->getState('securityKey');
        $record = Manager::model()->findByAttributes(array('id' => $id));
        if ((isset($record)) && ($skey === $record->skey)) {
            return TRUE;
        }
        return FALSE;
    }

//
//::Start code for control of main menu (/modules/service/views/layouts/main.php)
//
    /**
     * @var string alias for menu item is currently active (url of menu item and
     *  current page is match)
     */
    public $activeItem;

    /**
     * Is some menu item currently active or not?
     * 
     * @param string $item is alias of some menu item that will be tested
     * @return boolean 
     */
    public function isActiveItem($item = '')
    {
        if ($item === $this->activeItem)
            return TRUE;
        else
            return FALSE;
    }
    
    /**
     * @var array aliases of main menu items
     */
    public $menuItemAlias = array('home', 'good', 'cust', 'order', 'reference',
                                'login', 'logout');
    
    /**
     * @var array attributes of main menu items
     */
    public $menuItemData = array(
        'home'      => array('label' => 'Главная',
                             'url'   => array('admin/index')),
        'good'      => array('label' => 'Номенклатура',
                             'url'   => array('admin/view', 'id' => 'product')),
        'cust'      => array('label' => 'Клиенты',
                             'url'   => array('admin/view', 'id' => 'customer')),
        'order'     => array('label' => 'Заказы',
                             'url'   => array('admin/view', 'id' => 'order')),
        'reference' => array('label' => 'Справочники',
                             'url'   => array('admin/view', 'id' => 'reference')),
        'login'     => array('label' => 'Вход',
                             'url'   => array('manager/login')),
        'logout'    => array('label' => 'Выход',
                             'url'   => array('manager/logout')),        
    );
//::End code for control of main menu
}