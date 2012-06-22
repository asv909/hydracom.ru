<?php
/**
 * Description of UsersController
 *
 * @author asv
 */
class ManagerController extends Controller 
{
    private $manager;
    
    public function filters() 
    {
        return array('accessControl');
    }
 
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
   
    public function actionIndex() 
    {
        if(Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'manager_login');
        else 
        {
            $greetings = 'Здравствуйте ' . Yii::app()->user->manager_name . '!';
            $this->render('index', array('greetings' => $greetings));
            Yii::app()->end();
        }
    }

    public function actionLogin() 
    {
        if(!Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'manager');
        if($_SERVER['REMOTE_ADDR'] !== $this->module->restrict_authen['office_IP'])
        {
            $this->render('access_deny', array('greetings' => "Ваш текущий статус не соответствует одному из критериев допуска!"));
            Yii::app()->end();
        }
        $this->manager = new Manager;
        $this->performAjaxValidation($this->manager);
        if(isset($_POST['Manager']))
        {
            $this->manager->attributes = $_POST['Manager'];
            if($this->manager->validate() && $this->manager->login())
                $this->redirect(Yii::app()->user->returnUrl);
            if(Helpers::restrictNumberOfAttempts($this->module->restrict_authen['num_of_attempts'], $this->module->restrict_authen['timeout']))
            {
                $this->render('access_deny', array('greetings' => "Вы исчерпали лимит попыток аутентификации, попробуйте позже!"));
                Yii::app()->end();
            }
        }
        $this->render('login', array('login_form' => $this->manager));
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
?>