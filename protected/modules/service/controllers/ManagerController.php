<?php
/**
 * Description of UsersController
 *
 * @author asv
 */
class ManagerController extends Controller 
{
    public $session;
    
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
        if(isset(Yii::app()->params->selenium)) 
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
        }
    }

    public function actionLogin() 
    {
        $session=new CHttpSession;
        $session->open();
        if(!Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'manager');
        if($_SERVER['REMOTE_ADDR']!==Yii::app()->params->IP)
        {
            $this->render('access_deny', array('greetings' => "Ваш статус не соответствует одному из критериев допуска!"));
            Yii::app()->end();
        }
        $manager = new Manager;
        $this->performAjaxValidation($manager);
        if(isset($_POST['Manager']))
        {
            $i = $session->get('attempt_to_authenticate', 1);
            if($i>3) 
            {
                $session->close();
                $this->render('access_deny', array('greetings' => "Вы исчерпали лимит попыток аутентификации, попробуйте позже!"));
                Yii::app()->end();
            }
            else 
            {
                $i=$i+1;
                $session->add('attempt_to_authenticate', $i);
            }
            $manager->attributes = $_POST['Manager'];
            if($manager->validate() && $manager->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        $this->render('login', array('login_form' => $manager));
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