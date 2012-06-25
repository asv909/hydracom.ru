<?php
/**
 * Helpers class file
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &copy; 2012 RGK LLC
 */

/**
 * <var>Helpers</var> class is a set of static functions allocated to a separate class for reuse.
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Helpers.php v 1.0 2012-06-21 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @since 1.0
 */
class Helpers 
{
    /**
     * <var>createUrl</var> function is used to the construction of the route depending on the setting in the configuration property values 'testenv'. Function return appropriate URL.
     * @param string $route usually this is the route
     * @return string URL
     */
    static function createUrl($route)
    {
        return Yii::app()->params->testenv . $route;
    }

    /**
     * <var>createHash</var> function is used to compute the hash value for set of some parameters. Function return computed <var>sha1()</var> hash string.
     * @param string $string1 this is user name, taken from $POST['form']
     * @param string $string2 this is user password, taken from $POST['form']
     * @param string $string3 this is user salt, taken from appropriate DB-record
     * @param string $string4 this is special string for added security, taken from variable $suffix that was set within class of appropriate model
     * @return string hash string
     */
    static function createHash($string1, $string2, $string3, $string4)
    {
        sleep(1);
        return sha1($string1 . $string2 . $string3 . $string4);
    }

    /**
     * <var>restrictNumberOfAttempts</var> function is used to restrict number of authenticate attempt and setting timeout between series of attempts. Function return TRUE or FALSE depending on the number attempt of authorization exceeded or no and timeout between series of attempts has expired or no.
     * @param array $restricts this is $restrictAuthenticate array from ServiceModule.php
     * @return boolean TRUE or FALSE
     */
    static function restrictNumberOfAttempts($restricts) 
    {
        $session_ = new CHttpSession;
        $session_->setTimeout($restricts['timeout']);
        $session_->open();
        $attempt_ = $session_->get('countOfAttempts', 0) + 1;
        if($attempt_ >= $restricts['numberOfAttempts'])
        {
            if($session_->get('restrictTime', 0)===0)
                $session_->add('restrictTime', time());
            if((time()-$session_->get('restrictTime', 0)) >= $restricts['timeout']) 
            {
                $session_->remove('restrictTime');
                $session_->add('countOfAttempts', 1);
                $session_->close();
                return FALSE;
            }
            else 
            {
                $session_->close();
                return TRUE;
            }
        }
        else 
        {
            $session_->add('countOfAttempts', $attempt_);
            $session_->close();
            return FALSE;
        }
        return FALSE;
    }
}