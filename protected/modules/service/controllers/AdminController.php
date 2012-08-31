<?php
/**
 * AdminController class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 */

/**
 * The <var>AdminController</var> is .
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: AdminController.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.modules.service.
 * @since 1.0
 */
class AdminController extends ServiceController 
{
    /**
     * Index action gives to browser the manager's Home page.
     */
    public function actionIndex()
    {
        $this->initAction('home');
        
        $message = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
        $this->render('index', array('message' => $message,));
    }

    /*
     * Gives to browser the page with overview of data for selected menu item.
     * Default it's gives to browser the product items overview.
     */
    public function actionView($item = 'product')
    {
        $this->initAction($item);
        
        $dataProvider = new CActiveDataProvider($item);
        $this->render('view', array('dataProvider' => $dataProvider,));
    }

    /**
     * 
     */
    public function actionLook($id = 'brand')
    {
        $this->initAction($id);

        $dataProvider = new CActiveDataProvider($id, array(
            'criteria'=>array('order'=>'id ASC'),
            'pagination'=>array('pageSize'=>10),
        ));
        $this->render('look', array('dataProvider' => $dataProvider,));
    }
}