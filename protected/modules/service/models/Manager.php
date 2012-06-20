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
        private $record;
        private $suffix = "249?6H3xyz!";

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
                'message' => "Код защиты указан не верно!"),
        );
    }
   
    public function attributeLabels()
    {
        return array(
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня на 30 дней',
            'verifyCode' => 'Код защиты',
            );
    }

    public function authenticate()
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new ManagerIdentity($this->username,$this->password);
            $this->record = $this->findByAttributes(array('login' => $this->username));
            if(!isset($this->record))
            {
                $this->addError('username', 'Пользователь с таким логином в системе не зарегистрирован!');
                return FALSE;                
            }
            $this->_identity->setRecord($this->record);
            $this->_identity->setHash(Helpers::createHash($this->username, $this->password, $this->record->salt, $this->suffix));
            if(!$this->_identity->authenticate())
            {
                $this->addError('password', 'Введенный Вами пароль не совпадает с эталоном!');
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
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
            $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days or 0 if $rememberMe is TRUE or FALSE
            if($duration!==0)
                Yii::app()->user->login($this->_identity, $duration);
            return TRUE;
        }
        else
            return FALSE;
    }
}
?>