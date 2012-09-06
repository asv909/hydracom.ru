<?php
/**
 * Country class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>Country</var> is an AR-model for DB table `country`.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Country.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class Country extends CActiveRecord 
{
    /**
     * @var string $title is the header for data set of country names
     */
    public $title = 'Справочник: "Cтраны"';
    
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
        return 'country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'unique', 'message' => 'Такой элемент уже существует!'),
            array('name', 'required', 'message' => 'Введите данные!'),
            array('name', 'length', 'max'=>45, 'message' => 'Введен слишком длинный текст!'),
            //array('id, name', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id'   => 'ID',
                     'name' => 'Страна');
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models 
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        return new CActiveDataProvider($this, array('criteria' => $criteria));
    }
}