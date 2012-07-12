<?php
/**
 * UserController class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>UserController</var> is common component of the main application and 
 * maintains a base controller class.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: UserController.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class UserController extends Controller 
{
    public function actionNew()
    {
        $user = new User;
        $this->render('new', array('user' => $user));
    }
    
    public function actionCreate()
    {
        $user = new User;
        $user->attributes = $_POST['User'];
        if ($user->save()) {
            Yii::app()->user->setFlash('success', 'You have been signed up successfully');
            $this->redirect('/');            
        } else {
            $this->render('new', array('user' => $user));
        }
    }
}