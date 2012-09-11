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

        $Model = ucfirst($item);
        $newItem = new $Model();
        $formName = 'new_item';
        
        $this->performAjaxValidation($newItem, $formName);
        
        if (isset($_POST[$Model])) {
            $newItem->name = $_POST[$Model]['name'];
            $newItem->manager_id = Yii::app()->user->id;
            if ($newItem->validate()) {
                $newItem->save();
                $this->redirect('/service/admin/review/item/' . $item);
            }
        } 
        $this->render('new_item', array('newItem'  => $newItem,
                                        'item'     => $item,
                                        'formName' => $formName,));
    }
    
    /**
     * 
     */
    public function actionEdit($item = 'product', $id = '1')
    {
        $this->initAction($id);

        $Model = ucfirst($item);
        $editRaw = $Model::model()->findByPk($id);
        if ($editRaw === NULL) {
            throw new CHttpException(404, 'Ошибка: элемент с номером {$id} в {$model->title} не обнаружен!');
        }
        $formName = 'edit';
        
        $this->performAjaxValidation($editRaw, $formName);
        
        if (isset($_POST[$Model])) {
            $editRaw->name = $_POST[$Model]['name'];
            $editRaw->manager_id = Yii::app()->user->id;
            if ($editRaw->validate() && $editRaw->save()) {
                $this->redirect('/service/admin/review/item/' . $item);
            }
        }
	$this->render('edit', array('data'    => $editRaw,
                                    'item'     => $item,
                                    'id'       => $id,
                                    'formName' => $formName,));
    }
}