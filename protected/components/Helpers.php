<?php
/**
 * Helpers class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>Helpers</var> class is a set of static functions allocated to a separate
 *  class for reuse.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class Helpers 
{
    /**
     * <var>createUrl</var> function is used to the construction of the route 
     * depending on the setting in the configuration property values 'testenv'. 
     * Function return appropriate URL.
     * 
     * @param string $route usually this is the route
     * @return string URL
     */
    static function createUrl($route)
    {
        return Yii::app()->params->testenv . $route;
    }

    /**
     * <var>createHash</var> function is used to compute the hash value for set 
     * of some parameters. 
     * Function return computed <var>sha1()</var> hash string.
     * 
     * @param string $string1 is user name, taken from $POST['form']
     * @param string $string2 is user password, taken from $POST['form']
     * @param string $string3 is user salt, taken from appropriate DB-record
     * @param string $string4 is special string for added security, taken from 
     * variable $suffix that was set within class of appropriate model
     * @return string hash string
     */
    static function createHash($string1, $string2, $string3, $string4)
    {
        sleep(1);
        return sha1($string1 . $string2 . $string3 . $string4);
    }
}