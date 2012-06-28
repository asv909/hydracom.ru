<?php
/**
 * Manager class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>Manager</var> class is an AR-model for a database table `manager` and 
 * implements the business logic for managers authentication.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class Manager extends CActiveRecord 
{
    /**
     * @var string $username is text from appropriate field of managers login form
     * @var string $password is text from appropriate field of managers login form
     * @var boolean $rememberMe is TRUE or FALSE from appropriate checkbox of managers login form
     * @var string $verifyCode is text from appropriate field of managers login form (captcha)
     */
    public $username;
    public $password;
    public $rememberMe = FALSE;
    public $verifyCode;
    
    /**
     * //@var object $_identity used for storage instance of ManagerIdentity class
     */    
    private $_identity;
    private $_record;
    private $_suffix = "249?6H3xyz!";

    /**
     * 
     * @param string $className active record class name
     * @return CActiveRecord the static model of the specified AR class.
     */
    static public function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the name of the associated database table
     */
    public function tableName() 
    {
        return 'manager';
    }

    /**
     * @return array array of arrays the validation rules for attributes
     */
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

    /**
     * @return array the attribute labels are mainly used in error messages of validation
     */
    public function attributeLabels()
    {
        return array(
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня на 30 дней',
            'verifyCode' => 'Код защиты',
            );
    }

    /**
     * Authenticate manager in system
     * //@return boolean 
     */
    public function authenticate()
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new ManagerIdentity($this->username,$this->password);
            $this->_record = $this->findByAttributes(array('login' => $this->username));
            if(!isset($this->_record))
            {
                $this->addError('username', 'Пользователь с таким логином в системе не зарегистрирован!');
                return FALSE;                
            }
            $this->_identity->setRecord($this->_record);
            $this->_identity->setHash(Helpers::createHash($this->username, $this->password, $this->_record->salt, $this->_suffix));
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
            $duration = $this->rememberMe ? 3600*24*30 : 0;
            $this->_identity->rememberTime = $duration;
            return $this->_identity;
        }
        else
            return FALSE;
    }
}