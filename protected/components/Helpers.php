<?php
/**
 * Description of Helpers
 *
 * @author asv
 */
class Helpers 
{
    static function createUrl($url) 
    {
        return Yii::app()->params->testenv . $url;
    }

    static function checkHash($login, $secretword, $salt) 
    {
        return sha1($login . $secretword . $salt . Yii::app()->params->param);  
    }    
}