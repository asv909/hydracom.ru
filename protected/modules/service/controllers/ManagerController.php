<?php

/**
 * Description of UsersController
 *
 * @author asv
 */
class ManagerController extends Controller 
{
    public function actionIndex() 
    {
        if(Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl='service/manager/login');
        else 
        {
            $greetings = 'Здравствуйте ' . Yii::app()->user->manager_name . '!';
            $this->render('index', array('greetings' => $greetings));
        }
    }

    public function actionLogin() 
    {
        $manager = new Manager;
        if(isset($_POST['Manager']))
        {
            $manager->attributes=$_POST['Manager'];
            if($manager->validate())
                $this->redirect(Yii::app()->user->returnUrl='/manager');
        }
        $this->render('login', array('login_form' => $manager));
    }
    
    public function actionLogout() 
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl='/manager');
    }
}