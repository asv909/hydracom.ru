<?php

/**
 * ViewForm class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>ViewForm</var> is .
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: ViewForm.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class LookupForm extends CFormModel 
{
    /**
     *
     * @var type 
     */
    public $name = array('№п/п', 'Наименование');
    
    /**
     *
     * @var type 
     */
    public $data = array();
    
    /**
     *
     * @return type 
     */
    public function getData()
    {
        switch ($_GET['id']) {
            case 'brand':
                $this->data = Brand::model()->findAll();
                break;
            case 'country':
                $this->data = Country::model()->findAll();
                break;
            case 'measure':
                $this->data = Measure::model()->findAll();
                break;            
            default:
                echo 'Указанный `id` маршрута отсутствует в списке допустимых значений';
                Yii::app()->end();
        }
    }
}