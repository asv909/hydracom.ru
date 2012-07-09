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
 * @version $Id: ManagerIdentity.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage Service module
 * @since 1.0
 */
class ManagerIdentity extends CUserIdentity 
{
    /**
     * @var СActiveRecord $_record used for storage single db-record appropriate
     *  username
     */
    private $_record;
    
    /**
     * @var string $_hash is hash-string for appropriate pair username and 
     * password
     */
    private $_hash;
    
    /**
     * @var integer $_id is user ID, such as primary key value of appropriate 
     * db-record
     */
    private $_id;

    /**
     * @var integer $rememberTime sets the amount of time during will be act the
     *  autologin which based on cookies 
     */
    public $rememberTime;
    
    /**
     * @var string $securityKey is unique string for additional security provides
     *  protection from attempts to use obsolete cookie with autologin
     */
    public $securityKey;

    /**
     * Setter for private property $_record
     * 
     * @param CActiveRecord $record is single db-record appropriate username
     */
    public function setRecord($record)
    {
        $this->_record = $record;
    }

    /**
     * Setter for private property $_hash
     * 
     * @param string $hash is result of sha1() for appropriate pair username and 
     * password
     */
    public function setHash($hash)
    {
        $this->_hash = $hash;
    }

    /**
     * Getter for ID of current user identity
     * 
     * @return integer identity ID 
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Checks the user identity
     * 
     * @return boolean TRUE if identical, otherwise FALSE  
     */
    public function authenticate()
    {
        if (!isset($this->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!isset($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {   
            if ($this->_record === null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } elseif ($this->_record->hash !== $this->_hash) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $this->_record->id;
                $this->setState('managerName', $this->_record->name . ' ' . $this->_record->middlename);
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;    
    }
}