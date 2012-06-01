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
            $this->redirect(Yii::app()->user->returnUrl = 'manager_login');
        else 
        {
            $greetings = 'Здравствуйте ' . Yii::app()->user->manager_name . '!';
            $this->render('index', array('greetings' => $greetings));
        }
    }

    public function actionLogin() 
    {
        if(!Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->user->returnUrl = 'manager');
        $manager = new Manager;
        if(isset($_POST['Manager']))
        {
            $manager->attributes = $_POST['Manager'];
            if($manager->validate() && $manager->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        $this->render('login', array('login_form' => $manager));
    }
    
    public function actionLogout() 
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}