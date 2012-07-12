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
     * @var Manager $_loginForm is instance of the Manager class. 
     */
    private $_loginForm;
    
    /**
     * @var CHttpSession $_session is instance of the CHttpSession class.
     */
    private $_session;
    
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
    private function Session($action, $data=array())
    {
        if (!isset($this->_session)) {
            $this->_session = new CHttpSession;
            $this->_session->setTimeout($this->module->rememberTime);
        }
        switch ($action) {
            case 'start':
                $this->_session->open();
                if (isset($data)) {
                    $this->_session->add('action', $data['action']);
                }
                $restrict_ = FALSE;
                break;
            case 'control':
                $attempt_ = $this->_session->get('countOfAttempts', 0) + 1;
                if ($attempt_ >= $data['numberOfAttempts']) {
                    if ($this->_session->get('restrictTime', 0) === 0) {
                        $this->_session->add('restrictTime', time());
                        $this->_session->add('restrict', 1);
                        $restrict_ = TRUE;
                    } elseif ((time()-$this->_session->get('restrictTime', 0)) < $data['timeout']) {
                        $restrict_ = TRUE;
                    } else {
                        $this->_session->remove('restrictTime');
                        $this->_session->remove('restrict');
                        $this->_session->add('countOfAttempts', 1);
                        $restrict_ = FALSE;
                    }
                } else {
                    $this->_session->add('countOfAttempts', $attempt_);
                    $restrict_ = FALSE;
                }                
                break;
            case 'check':
                if ($this->_session->get('restrict', 0)) {
                    $restrict_ = TRUE;
                } else {
                    $restrict_ = FALSE;
                }
                break;
            case 'unset':
                $this->_session->destroy();
                $restrict_ = FALSE;
                break;
            default:
                $this->_session->close();
                $restrict_ = FALSE;
                break;
        }
        return $restrict_;
    }
    
    /**
     * Index action gives to browser main page for service module, but if is Guest 
     * then redirect to login page
     */
    public function actionIndex()
    {
        $this->Session('start', array('action' => 'index'));
        if ((!Yii::app()->user->isGuest) && ($this->checkSecutityKey())) {
            $message_ = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
            $this->Session('stop');
            $this->render('index', array('message' => $message_));
            Yii::app()->end();
        }
        $this->Session('stop');
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl = 'login');
     }

    /**
     * AJAX-validates form data and returns the results to brouser in JSON format
     * 
     * @param Manager $manager current instance of the object model the Manager
     */
    private function performAjaxValidation($loginForm)
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
        $this->Session('start', array('action' => 'login'));

        //check the restriction by IP-address
        $officeIP_ = $this->module->restrictAuthenticate['officeIP'];
        if (isset($officeIP_) && ($officeIP_ !== '') && ($_SERVER['REMOTE_ADDR'] !== $officeIP_)) {
            $this->render('forbidden', array(
                'message' => 'Ваш статус не соответствует критерю допуска!'));
            Yii::app()->user->logout();
            $this->Session('stop');
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
                    $this->Session('stop');
                    $this->redirect(Yii::app()->user->returnUrl = 'manager');
                }
            }
            if ($this->Session('control', $this->module->restrictAuthenticate)) {
                $this->Session('stop');
                $this->render('forbidden', array(
                    'message' => 'Вы исчерпали лимит попыток аутентификации!'));
                Yii::app()->end();
            }
        }
        if ($this->Session('check')) {
            $this->render('forbidden', array(
                'message' => 'Доступ к форме аутентификации временно запрещен!'));
            $this->Session('stop');
            Yii::app()->end();
        }
        $layout_ = Yii::app()->controller->layout;
        Yii::app()->controller->layout = 'login';
        $this->Session('stop');
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
        $this->Session('unset');
        $this->redirect(Yii::app()->homeUrl);
    }
}