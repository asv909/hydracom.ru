<?php
/**
 * ManagerController class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * <var>ManagerController</var> class is a controller which provides authentication
 *  of managers.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: ManagerController.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class ManagerController extends ServiceController 
{
    /**
     * @var string $layout the default layout for the controller view. 
     */
    public $layout = '/layouts/column1';
    
    /**
     * 
     */
    public $defaultAction = 'login';

    /**
     * @var Manager $_loginForm is instance of the Manager class. 
     */
    private $_loginForm;
    
    /**
     * Set filter performs authorization checks for the specified actions
     * 
     * @return array
     */
    public function filters()
    {
        return array('accessControl');
    }

    /**
     * Setting rules for access control to actions of this controller.
     * 
     * @return array 
     */
    public function accessRules()
    {
        return array(
            array('allow',
                  'actions' => array('captcha', 'index', 'login', 'logout'),
                  'users'   => array('*')),
            array('deny', 
                  'users' => array('*')),
        );
    }
 
    /**
     * Setting external action for a class Captcha
     * 
     * Note: for test mode sets 'fixedVerifyCode' property
     * @return array 
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class'           => 'CCaptchaAction',
                'fixedVerifyCode' => Yii::app()->params->test,
            ),
        );
    }
    
    /**
     * Login action gives to brouser the manager login form, validate form's 
     * data and authenticate user (ie manager)
     */
    public function actionLogin()
    {
        $this->Session('start');
        $this->activeItem = $this->menuItemAlias[5];
        $restrict = $this->module->restrictAuthenticate;
        $officeIP = $restrict['officeIP'];
        //check the restriction by IP-address
        if (isset($officeIP) && ($officeIP !== '') && ($_SERVER['REMOTE_ADDR'] !== $officeIP)) {
            $this->render('forbidden', array(
                'message' => 'Ваш статус не соответствует критерю допуска!'));
            Yii::app()->end();
        }
        $this->_loginForm = new LoginForm;
        $this->performAjaxValidation($this->_loginForm);
        if (isset($_POST['LoginForm'])) {
            $this->_loginForm->attributes = $_POST['LoginForm'];
            if ($this->_loginForm->validate()) {
                $identity = $this->_loginForm->login();
                if ($identity !== NULL) {
                    $identity->setState('userID', $identity->getId());
                    $identity->setState('securityKey', $identity->securityKey);
                    Yii::app()->user->login($identity, $identity->rememberTime);
                    $this->redirect('/service/admin/index');
                }
            }
            if ($this->Session('control', $restrict)) {
                $this->render('forbidden', array(
                    'message' => 'Вы исчерпали лимит попыток аутентификации!'));
                Yii::app()->end();
            }
        }
        if ($this->Session('check', $restrict)) {
            $this->render('forbidden', array(
                'message' => 'Доступ к форме аутентификации временно запрещен!'));
            Yii::app()->end();
        }
        $this->render('login', array('login_form' => $this->_loginForm));
    }

    /**
     * Logout and redirect to home page
     */
    public function actionLogout()
    {
        $this->Session('unset');
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}