<?php
/**
 * Submenu_item class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>Submenu_item</var> class is an AR-model for DB table `submenu_item`.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Submenu_item.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class Submenu_item extends CActiveRecord 
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
        return 'submenu_item';
    }
    
    /**
     * Defining relations with other of AR-classes
     * 
     * @return array list declarations of relations with other AR-classes
     */
    public function relations() 
    {
        return array(
            'url'       => array(self::BELONGS_TO, 'Url', 'url_id'),
            'menu_item' => array(self::BELONGS_TO, 'Menu_item', 'menu_item_id'),
        );
    }    
}