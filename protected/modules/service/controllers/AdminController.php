<?php
/**
 * AdminController class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 */

/**
 * The <var>AdminController</var> is main controller providing administrative
 * functionality of system.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: AdminController.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.modules.service.
 * @since 1.0
 */
class AdminController extends ServiceController 
{
    /**
     * This is name of current Model
     * @var string 
     */
    private $_Model;
    
    /**
     * This is instance of current Model
     * @var ActiveRecord instance
     */
    private $_model;
    
    /**
     * Index action gives into browser the manager's Home page.
     */
    public function actionIndex()
    {
        $this->initAction('home');
        
        $message = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
        $this->render('index', array('message' => $message,));
    }

    /*
     * Gives into browser the page with overview collection of data for selected
     * menu item. Default it's gives into browser the product items collection 
     * overview.
     * 
     * @param string $item is name of item's (directory's) for review
     */
    public function actionReview($item = 'product')
    {
        $this->initAction($item);
        
        $_Model = ucfirst($item);
        $_model = new $_Model('search');
	$_model->unsetAttributes();  // clear any default values
	
        if (isset($_GET[$_Model])) {
            $_model->attributes=$_GET[$_Model];
        }
	$this->render('view', array('model' => $_model, 'item' => $item,));
    }

    /**
     * It's generate and display form for add new item element then validate 
     * input data and save into DB
     * 
     * @param string $item is name of item's (directory's) to which will add a
     * new element
     */
    public function actionAdd_new($item = 'product')
    {
        $this->initAction($item);

        $_Model  = ucfirst($item);
        $_model  = new $_Model();
        $formName = 'new_item';
        
        $this->performAjaxValidation($_model, $formName);
        
        if (isset($_POST[$_Model])) {
            $_model->name = $_POST[$_Model]['name'];
            $_model->manager_id = Yii::app()->user->id;
            if ($_model->validate()) {
                $_model->save();
                $this->redirect('/service/admin/review/item/' . $item);
            }
        } 
        $this->render('new_item', array('newItem'  => $_model,
                                        'item'     => $item,
                                        'formName' => $formName,));
    }
    
    /**
     * This action perform search required element in DB, generates and displayes
     * edit form, then validates and saves edited data into DB
     * 
     * @param string $item is name of item's (directory's) which to be edited
     * @param mixed $id is number rows containing the data to be edited
     */
    public function actionEdit($item = 'product', $id = '1')
    {
        $this->initAction($id);

        $_Model = ucfirst($item);
        $_model = $_Model::model()->findByPk($id);
        if ($_model === NULL) {
            throw new CHttpException(404, 'Ошибка: элемент с номером ' 
                                           . $id 
                                           . ' в ' 
                                           . $_Model::model()->title 
                                           . ' не обнаружен!');
        }
        $formName = 'edit';
        
        $this->performAjaxValidation($_model, $formName);
        
        if (isset($_POST[$_Model])) {
            $_model->name = $_POST[$_Model]['name'];
            $_model->manager_id = Yii::app()->user->id;
            if ($_model->validate() && $_model->save()) {
                $this->redirect('/service/admin/review/item/' . $item);
            }
        }
	$this->render('edit', array('data'     => $_model,
                                    'item'     => $item,
                                    'id'       => $id,
                                    'formName' => $formName,));
    }
}