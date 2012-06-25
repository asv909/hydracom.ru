<?php
/**
 * ManagerIdentity class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>ManagerIdentity</var> class extends a base class for representing 
 * identities that are authenticated based on a username and a password, 
 * and implement authenticate with the actual authentication scheme.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class ManagerIdentity extends CUserIdentity 
{
    private $_record;
    private $_hash;
    private $_id;

    public $rememberTime;
    
    public function authenticate() 
    {
        if(!isset($this->username))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif(!isset($this->password)) 
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {   
            if($this->_record===null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            elseif($this->_record->hash!==$this->_hash)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id = $this->_record->id;
                $this->setState('managerName', $this->_record->name . ' ' . $this->_record->middlename);
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;    
    }
 
    public function getId() 
    {
        return $this->_id;
    }
    
    public function setRecord($record) 
    {
        $this->_record = $record;
    }

    public function setHash($hash) 
    {
        $this->_hash = $hash;
    }
}