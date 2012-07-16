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
     * @var string $layout the default layout for the views
     */
    public $layout= 'column2';
    
    /*
     * 
     */
    private $_model;
        
    /**
     * 
     */
    public function actionIndex()
    {
        if (!isset(Yii::app()->user->managerName)) {
            $message_ = 'Здравствуйте!';
        } else {
            $message_ = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
        }
        $this->render('index', array('message' => $message_));
        Yii::app()->end();
    }

    /**
     * 
     */
    public function actionLookup()
    {
        if (!isset($_GET['id'])) {
            echo 'У маршрута отстутствует параметр id';
            Yii::app()->end();
        }
        $_model = new $_GET['id'];
    }

    /**
     * 
     */
    public function actionSearch()
    {
    
    }

    /**
     * 
     */
    public function actionUpdate()
    {
    
    }
    /**
     * 
     */
    public function actionSave()
    {
    
    }
    /**
     * 
     */
    public function actionNew()
    {
    
    }
    /**
     * 
     */
    public function actionShow()
    {
    
    }
    /**
     * 
     */
    public function actionFind()
    {
    
    }
}