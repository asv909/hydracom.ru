<?php
/**
 * Helpers class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>Helpers</var> class is a set of static functions allocated to a separate
 *  class for reuse.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class ManagerController extends ServiceController 
{
    /**
     * @var Manager $_manager is instance of the Manager class. 
     */
    private $_manager;
    
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
     * Setting external action for class captcha
     * 
     * Note: for test mode set 'fixedVerifyCode' property
     * @return array 
     */
    public function actions()
    {
        if (isset(Yii::app()->params->test) && (Yii::app()->params->test)) {
            return array(
                'captcha' => array(
                    'class'           => 'CCaptchaAction',
                    'fixedVerifyCode' => 'dolotut',
                ),
            );
        } else {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                ),
            );
        }
    }

    /**
     * Index action gives to browser main page for service module, but if is Guest 
     * then redirect to login page
     */
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->user->returnUrl = 'login');
        } else {
            $message_ = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
            $this->render('index', array('message' => $message_));
            Yii::app()->end();
        }
    }

    /**
     * AJAX-validates form data and returns the results to brouser in JSON format
     * 
     * @param Manager $manager current instance of the object model the Manager
     */
    protected function performAjaxValidation($manager)
    {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'login_form')) {
            echo CActiveForm::validate($manager);
            Yii::app()->end();
        }
    }
    
    /**
     * Login action gives to brouser the manager login form, validate form's 
     * data and authenticate user (ie manager)
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->user->returnUrl = 'manager');
        }
        //check the restriction by IP-address
        if (isset($this->module->restrictAuthenticate['officeIP'])
            && ($this->module->restrictAuthenticate['officeIP'] !== '')
            && ($_SERVER['REMOTE_ADDR'] !== $this->module->restrictAuthenticate['officeIP'])) {
            $this->render('forbidden', array(
                'message' => 'Ваш текущий статус не соответствует одному из критериев допуска!'));
            Yii::app()->user->logout();
            Yii::app()->end();
        }
        
        $this->_manager = new Manager;
        $this->performAjaxValidation($this->_manager);
        
        if (isset($_POST['Manager'])) {
            $this->_manager->attributes = $_POST['Manager'];
            if ($this->_manager->validate()) {
                $identity_ = $this->_manager->login();
                if ($identity_ !== NULL) {
                    $identity_->setState('userID', $identity_->getId());
                    $identity_->setState('securityKey', $identity_->securityKey);
                    Yii::app()->user->login($identity_, $identity_->rememberTime);
//------------------------------>
//------------------------------< 
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            //check limits on the number of authentication attempts
            if (Helpers::restrictNumberOfAttempts($this->module->restrictAuthenticate)) {
                $this->render('forbidden', array(
                    'message' => 'Вы исчерпали лимит попыток аутентификации, попробуйте позже!'));
                Yii::app()->user->logout();
                Yii::app()->end();
            }
        }
        $layout_ = Yii::app()->controller->layout;
        Yii::app()->controller->layout = 'login';
        $this->render('login', array('login_form' => $this->_manager));
        Yii::app()->controller->layout = $layout_;
        Yii::app()->end();
    }

    /**
     * Logout and redirect to home page
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}