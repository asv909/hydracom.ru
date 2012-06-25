<?php
/**
 * Helpers class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>Helpers</var> class is a set of static functions allocated to a separate class for reuse.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class ManagerController extends ServiceController 
{
    /**
     * @var object is instance of the model class Manager. 
     */
    private $_manager;
    
    /**
     * Set filter performs authorization checks for the specified actions
     * @return array 
     */
    public function filters() 
    {
        return array('accessControl');
    }

    /**
     * Setting rules for access control to actions of this controller.
     * @return array 
     */
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions' => array('captcha', 'index', 'login', 'logout'),
                'users' => array('*'),
                ),
            array('deny',
                'users' => array('*'),
                ),
            );
    }
 
    /**
     * Setting external action classe captcha
     * Note: for test mode set 'fixedVerifyCode' property
     * @return array 
     */
    public function actions() 
    {
        if(isset(Yii::app()->params->test) && Yii::app()->params->test) 
        {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    'fixedVerifyCode' => 'dolotut',
                    ),
                );
        }
        else 
        {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    ),
                );
        }
    }

    /**
     * Index action gives main page for service module or redirect to login page
     */
    public function actionIndex() 
    {
        if(Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'login');
        else 
        {
            $greetings = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
            $this->render('index', array('greetings' => $greetings));
            Yii::app()->end();
        }
    }

    /**
     * Login action gives the manager login form, validate form's data, 
     * authenticate manager
     */
    public function actionLogin() 
    {
        if(!Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'manager');
        //check restrict on IP address
        if($_SERVER['REMOTE_ADDR'] !== $this->module->restrictAuthenticate['officeIP'])
        {
            $this->render('forbidden', array('greetings' => "Ваш текущий статус не соответствует одному из критериев допуска!"));
            Yii::app()->user->logout();
            Yii::app()->end();
        }
        
        $this->_manager = new Manager;
        $this->performAjaxValidation($this->_manager);
        
        if(isset($_POST['Manager']))
        {
            $this->_manager->attributes = $_POST['Manager'];
            
            if($this->_manager->validate())
            {
                $identity_ = $this->_manager->login();
                Yii::app()->user->login($identity_, $identity_->rememberTime);
                $this->redirect(Yii::app()->user->returnUrl);
            }
            //check restrict on number of attempts 
            if(Helpers::restrictNumberOfAttempts($this->module->restrictAuthenticate))
            {
                $this->render('forbidden', array('greetings' => "Вы исчерпали лимит попыток аутентификации, попробуйте позже!"));
                Yii::app()->user->logout();
                Yii::app()->end();
            }
        }
        
        $this->render('login', array('login_form' => $this->_manager));
        Yii::app()->end();
    }

    protected function performAjaxValidation($manager)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='login_form')
        {
            echo CActiveForm::validate($manager);
            Yii::app()->end();
        }
    }
    
    public function actionLogout() 
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}