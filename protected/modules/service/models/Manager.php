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
     */
    public $username = NULL;
    
    /**
     * @var string $password is text from appropriate field of managers login form
     */
    public $password = NULL;
    
    /**
     * @var boolean $rememberMe is TRUE or FALSE from appropriate checkbox of managers login form
     */
    public $rememberMe = FALSE;

    /**
     * @var string $verifyCode is text from appropriate field of managers login form (captcha)
     */
    public $verifyCode = NULL;
    
    /**
     * @var ManagerIdentity $_identity used for storage instance of ManagerIdentity class
     */    
    private $_identity = NULL;
    
    /**
     * @var CActiveRecord $_record used for storage single db-record appropriate username or NULL if record doesn't find
     */
    private $_record = NULL;

    /**
     * @var string $_suffix is a special string for additional security
     */
    private $_suffix = "249?6H3xyz!";

    /**
     * Override of parent method
     * @param string $className active record class name
     * @return CActiveRecord the static model of the specified AR class.
     */
    static public function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Define and return DB-table name
     * @return string the name of the associated database table
     */
    public function tableName() 
    {
        return 'manager';
    }

    /**
     * Determines and returns the validation rules
     * @return array array of arrays with the validation rules for attributes
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
     * Determines and returns the attributes and labels for form fields
     * @return array array of the attribute labels are mainly used in error messages of validation
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
     * Sets the error messages depending on the outcome of the authentication
     */
    private function setErrorMessage()
    {
        if($this->_identity->errorCode===ManagerIdentity::ERROR_UNKNOWN_IDENTITY)
            $this->addError('password', 'Аутентификация не выполнена ...');
        if($this->_identity->errorCode===ManagerIdentity::ERROR_USERNAME_INVALID)
            $this->addError('username', 'Введенный Вами логин не зарегистрирован в системе!');
        if($this->_identity->errorCode===ManagerIdentity::ERROR_PASSWORD_INVALID)
            $this->addError('password', 'Введенный Вами пароль не совпадает с эталоном!');        
    }

    /**
     * Authenticate manager in system
     * @return boolean result of the authentication 
     */
    public function authenticate()
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new ManagerIdentity($this->username,$this->password);
            if(!isset($this->_record))
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
                $this->setErrorMessage();
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Sets <var>rememberTime</var> property and return current instance of ManagerIdentity.
     * @return ManagerIdentity 
     */
    public function login()
    {
        if($this->authenticate())
        {
            $duration = $this->rememberMe ? 3600*24*30 : 0;
            $this->_identity->rememberTime = $duration;
        }
        return $this->_identity;
    }
}