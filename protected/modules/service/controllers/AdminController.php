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
     * It's instance of current Model
     * @var ActiveRecord instance
     */
    private $_model;
    
    /**
     * Index action gives into browser the manager's Home page.
     */
    public function actionIndex($item = 'home')
    {
        if (Yii::app()->params->testenv === '') {                               // This condition need to bypass security in test mode
            $this->initAction($item);
            $message = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
        } else {
            $message = 'Здравствуйте уважаемый Тестер!';
        }
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
        if (Yii::app()->params->testenv === '') {                               // This condition need to bypass security in test mode
            $this->initAction($item);
        }
        
        $Model = ucfirst($item);                                                 // $Model @var string is name for initialise of current Model
        $this->_model = new $Model('search');
	$this->_model->unsetAttributes();                                        // clear any default values
	
        if (isset($_GET[$Model])) {
            $this->_model->attributes=$_GET[$Model];
        }
	$this->render('view', array('model' => $this->_model, 'item' => $item,));
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
        if (Yii::app()->params->testenv === '') {                               // This condition need to bypass security in test mode
            $this->initAction($item);
        }
        
        $Model  = ucfirst($item);                                                // $Model @var string is name for initialise of current Model
        $this->_model  = new $Model();
        $formName = 'new_item';
        
        $this->performAjaxValidation($this->_model, $formName);
        
        if (isset($_POST[$Model])) {
            $this->_model->name = $_POST[$Model]['name'];
            
            if (Yii::app()->params->testenv !== '') {                           // This condition forcibly sets "1" the value of model's
                $this->_model->manager_id = 1;                                 // attribute "manager_id" when app run in test mode
            } else {
                $this->_model->manager_id = (int)Yii::app()->user->id;
            }

            if ($this->_model->validate()) {
                $this->_model->save();

                $this->redirect(Yii::app()->params->testenv                      // in test mode redirect link should be preceded by "/index-test.php"
                                . '/service/admin/review/item/'
                                . $item);
            }
        } 
        $this->render('new_item', array('newItem'  => $this->_model,
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
        if (Yii::app()->params->testenv === '') {                               // This condition need to bypass security in test mode
            $this->initAction($item);
        }

        $Model = ucfirst($item);     // $Model @var string is name for initialise of current Model
        $this->_model = $Model::model()->findByPk($id);
        if ($this->_model === NULL) {
            throw new CHttpException(404, 'Ошибка: элемент с номером ' 
                                           . $id 
                                           . ' в ' 
                                           . $Model::model()->title 
                                           . ' не обнаружен!');
        }
        $formName = 'edit';
        
        $this->performAjaxValidation($this->_model, $formName);
        
        if (isset($_POST[$Model])) {
            $this->_model->name = $_POST[$Model]['name'];
            
            if (Yii::app()->params->testenv !== '') {                           // This condition forcibly sets "1" the value of model's
                $this->_model->manager_id = 1;                                 // attribute "manager_id" when app run in test mode
            } else {
                $this->_model->manager_id = (int)Yii::app()->user->id;
            }
          
            if ($this->_model->validate() && $this->_model->save()) {
                $this->redirect(Yii::app()->params->testenv                      // in test mode redirect link should be preceded by "/index-test.php"
                                . '/service/admin/review/item/'
                                . $item);
            }
        }
	$this->render('edit', array('data'     => $this->_model,
                                    'item'     => $item,
                                    'id'       => $id,
                                    'formName' => $formName,));
    }
}