<?php

/**
 * Description of UserIdentity
 *
 * @author asv
 */
class ManagerIdentity extends CUserIdentity 
{
    private $_id;
    
    public function authenticate() 
    {
        $record=Manager::model()->findByAttributes(array('login'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->hash!==Helpers::checkHash($this->username, $this->password,$record->salt))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('manager_name', $record->name . ' ' . $record->middlename);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId() 
    {
        return $this->_id;
    }
}