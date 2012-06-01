<?php

/**
 * Description of Manager
 *
 * @author asv
 */
class Manager extends CActiveRecord 
{
        public $username;
        public $password;
        public $rememberMe = false;

        private $_identity;

    static public function model($className = __CLASS__) 
    {
        return parent::model($className);
    }

    public function tableName() 
    {
        return 'manager';
    }

    public function rules() 
    {
        return array(
            array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    /**
    * @param string $attribute имя поля, которое будем валидировать
    * @param array $params дополнительные параметры для правила валидации
    */
    public function authenticate($attribute,$params)
    {
        $this->_identity=new ManagerIdentity($this->username,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password','Неправильное имя пользователя или пароль.');
        else
            Yii::app()->user->login($this->_identity);
            
    }    
    
}