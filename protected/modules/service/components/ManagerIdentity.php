<?php
/**
 * Description of UserIdentity
 *
 * @author asv
 */
class ManagerIdentity extends CUserIdentity 
{
    private $record;
    private $hash;
    private $_id;
    
    public function authenticate() 
    {
        if(!isset($this->username))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif(!isset($this->password)) 
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {   
            if($this->record===null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            elseif($this->record->hash!==$this->hash)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id = $this->record->id;
                $this->setState('manager_name', $this->record->name . ' ' . $this->record->middlename);
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
        $this->record = $record;
    }

    public function setHash($hash) 
    {
        $this->hash = $hash;
    }
}
?>