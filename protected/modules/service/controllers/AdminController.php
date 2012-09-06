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
    public function actionReview($item = 'product')
    {
        $this->initAction($item);
        
        $dataProvider = new CActiveDataProvider($item, array(
            'criteria'=>array(
                'order'=>'name ASC',
        )));
        $this->render('view', array('dataProvider' => $dataProvider));
    }

    /**
     * 
     */
    public function actionAdd_new($item = 'product')
    {
        $this->initAction($item);

        $model = ucfirst($item);
        $new_item = new $model;
        
        $form_id = 'new_item';
        $this->performAjaxValidation($new_item, $form_id);
        
        if (isset($_POST[$model])) {
            $new_item->name = $_POST[$model]['name'];
            $new_item->manager_id = Yii::app()->user->id;
            if ($new_item->validate()) {
                $new_item->save();
                $this->redirect('/service/admin/review/item/' . $item);
            }
        } 
        $this->render('new_item', array('new_item' => $new_item,
                                       'item' => $item,
                                       'form_id' => $form_id,));
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