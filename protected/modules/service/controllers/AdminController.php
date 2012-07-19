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
     * 
     */
    public function actionIndex()
    {
        if (!isset(Yii::app()->user->managerName)) {
            $message = 'Здравствуйте!';
        } else {
            $message = 'Здравствуйте ' . Yii::app()->user->managerName . '!';
        }
        $this->render('index', array('message' => $message));
    }
        
    /**
     * Lists all models.
     */
    public function actionLook($id = 'brand')
    {
        $dataProvider = new CActiveDataProvider($id, array(
            'criteria'=>array('order'=>'id ASC'),
            'pagination'=>array('pageSize'=>10),
        ));
        $this->render('look', array('dataProvider' => $dataProvider,));
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