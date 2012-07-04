<?php

/**
 * Description of SaltAndHashGenerator
 *
 * @author asv
 */
class SaltAndHashGenerator 
{
    
    static public $login  = 'nev';
    static public $passwd = 'ErTrd-2007';
    static public $param  = '249?6H3xyz!';
    
    static public function SaltGen()
    {
        $newsalt = uniqid('', true);
        //echo 'Сгенерированный SALT: ' . $newsalt . '<br/>';
        return $newsalt;
    }

    static public function HashGen($salt)
    {
        //echo 'Данные на входе HASH-генератора: ' . self::$login . '<br/>' . self::$passwd . '<br/>' . $salt . '<br/>' . self::$param . '<br/>'; 
        return sha1(self::$login . self::$passwd . $salt . self::$param);  
    }
    
    static public function checkHash($salt)
    {
        //echo 'Данные на входе контрольной генерации ХЕША: ' . self::$login . '<br/>' . self::$passwd . '<br/>' . $salt . '<br/>' . self::$param . '<br/>'; 
        return sha1(self::$login . self::$passwd . $salt . self::$param);  
    }    
}