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
        public $rememberMe = FALSE;
        public $verifyCode;
        
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
            array('username, password', 'length', 'max' => 12),
            array('verifyCode', 'length', 'max' => 7),
            array('username, password', 'required', 
                    'message' => "Необходимо заполнить поле {attribute}!"),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
            array('verifyCode', 'captcha', 
                    'allowEmpty' => !Yii::app()->user->isGuest || !extension_loaded('gd'),
                    'message' => "Код защиты указан не верно!"
                ),
            );
    }
    
    public function attributeLabels()
    {
        return array(
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня на 30 дней',
            'verifyCode' => 'Код защиты от ботов',
            );
    }
    
    /**
    * @param string $attribute имя поля, которое будем валидировать
    * @param array $params дополнительные параметры для правила валидации
    */
    public function authenticate($attribute, $params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new ManagerIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
                $this->addError('password', 'Неправильное имя пользователя или пароль.');
        }
    }    
    
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity = new ManagerIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===ManagerIdentity::ERROR_NONE)
        {
            $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        else
            return false;
    }
}