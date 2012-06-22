<?php
/**
 * Description of Helpers
 *
 * @author asv
 */
class Helpers 
{
    static function createUrl($resource_name) 
    {
        return Yii::app()->params->testenv . $resource_name;
    }

    static function createHash($login, $secretword, $salt, $suffix) 
    {
        sleep(1);
        return sha1($login . $secretword . $salt . $suffix);  
    }
    
    static function restrictNumberOfAttempts($num_of_attempts = 5, $timeout = 600) 
    {
        $session = new CHttpSession;
        $session->setTimeout($timeout);
        $session->open();
        $attempt = $session->get('count_of_attempts', 0) + 1;
        if($attempt > $num_of_attempts)
        {
            if($session->get('restrict_time', 0)===0)
                $session->add('restrict_time', time());
            $elapsed_time = time()-$session->get('restrict_time', 0); 
            if($elapsed_time > $timeout) 
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
?>