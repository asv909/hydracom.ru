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
        sleep(1);
        return sha1($login . $secretword . $salt . Yii::app()->params->param);  
    }
    
    static function restrictNumberOfAttempts($num_of_attempts = 3, $timeout_attempts = 300) 
    {
        $session = new CHttpSession;
        $session->setTimeout($timeout_attempts);
        $session->open();
        $attempt = $session->get('count_of_attempts', 0) + 1;
        if($attempt > $num_of_attempts)
        {
            if($session->get('restrict_time', 0)===0)
                $session->add('restrict_time', time());
            $elapsed_time = time()-$session->get('restrict_time', 0); 
            if($elapsed_time > $timeout_attempts) 
            {
                $session->remove('restrict_time');
                $session->add('count_of_attempts', 1);
                $session->close();
                $restrict = FALSE;
            }
            else 
            {
                $session->close();
                $restrict = TRUE;
            }
        }
        else 
        {
            $session->add('count_of_attempts', $attempt);
            $session->close();
            $restrict = FALSE;
        }
        return $restrict;
    }
}