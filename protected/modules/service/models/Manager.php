<?php
/**
 * Manager class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * <var>Manager</var> class is an AR-model for DB table `manager` and 
 * implements the business logic for managers authentication.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Manager.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class Manager extends CActiveRecord 
{
    /**
     * Override of parent method
     * @param string $className active record class name
     * @return CActiveRecord the static model of the specified AR class.
     */
    static public function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Define and return DB-table name
     * 
     * @return string the name of the associated database table
     */
    public function tableName()
    {
        return 'manager';
    }
}