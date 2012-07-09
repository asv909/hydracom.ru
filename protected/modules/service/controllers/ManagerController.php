<?php
/**
 * ManagerController class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>ManagerController</var> class is a set of static functions allocated to a separate
 *  class for reuse.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: ManagerController.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage Service module
 * @since 1.0
 */
class ManagerController extends ServiceController 
{
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
     * Setting external action for class captcha
     * 
     * Note: for test mode set 'fixedVerifyCode' property
     * @return array 
     */
    public function actions()
    {
        $test_ = Yii::app()->params->test;
        if (isset($test_) && ($test_)) {
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
     * Checks and compares the two key security. First key stored in personal 
     * DB-record of the manager, second key stored in browsers cookie.
     * 
     * @return boolean TRUE if the both keys exist and matched or FALSE otherwise
     */
    protected function checkSecutityKey()
    {
        $id_ = Yii::app()->user->id;
        $skey_ = Yii::app()->user->getState('securityKey');
        $record_ = Manager::model()->findByAttributes(array('id' => $id_));
        if ((isset($record_)) && ($skey_ === $record_->skey)) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * Index action gives to browser main page for service module, but if is Guest 
     * then redirect to login page
     */
    public function actionIndex()
    {
        if ((!Yii::app()->user->isGuest) && ($this->checkSecutityKey())) {
            $message_ = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
            $this->render('index', array('message' => $message_));
            Yii::app()->end();
        }
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl = 'login');
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
     * Login action gives to brouser the manager login form, validate form's 
     * data and authenticate user (ie manager)
     */
    public function actionLogin()
    {
        //check the restriction by IP-address
        $officeIP_ = $this->module->restrictAuthenticate['officeIP'];
        if (isset($officeIP_) && ($officeIP_ !== '') && ($_SERVER['REMOTE_ADDR'] !== $officeIP_)) {
            $this->render('forbidden', array(
                'message' => 'Ваш текущий статус не соответствует одному из критериев допуска!'));
            Yii::app()->user->logout();
            Yii::app()->end();
        }
        
        $this->_loginForm = new LoginForm;
        $this->performAjaxValidation($this->_loginForm);
        
        if (isset($_POST['LoginForm'])) {
            $this->_loginForm->attributes = $_POST['LoginForm'];
            if ($this->_loginForm->validate()) {
                $identity_ = $this->_loginForm->login();
                if ($identity_ !== NULL) {
                    $identity_->setState('userID', $identity_->getId());
                    $identity_->setState('securityKey', $identity_->securityKey);
                    Yii::app()->user->login($identity_, $identity_->rememberTime);
                    $this->redirect(Yii::app()->user->returnUrl = 'manager');
                }
            }
            //check limits on the number of authentication attempts
            if (Helpers::restrictNumberOfAttempts($this->module->restrictAuthenticate)) {
                $this->render('forbidden', array(
                    'message' => 'Вы исчерпали лимит попыток аутентификации, попробуйте позже!'));
                Yii::app()->end();
            }
        }
        $layout_ = Yii::app()->controller->layout;
        Yii::app()->controller->layout = 'login';
        $this->render('login', array('login_form' => $this->_loginForm));
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