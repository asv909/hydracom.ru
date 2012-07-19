<?php

class Drafts 
{
    /**
     * <var>restrictNumberOfAttempts</var> function is used to restrict number 
     * of authenticate attempt and setting timeout between series of attempts. 
     * Function return TRUE or FALSE depending on the number attempt of 
     * authorization exceeded or no and timeout between series of attempts has 
     * expired or no.
     * 
     * @param array $restricts is $restrictAuthenticate array from ServiceModule.php
     * @return boolean TRUE if restrict or FALSE otherwise
     */
    static function restrictNumberOfAttempts($restricts)
    {
        $session_ = new CHttpSession;
        $session_->setTimeout($restricts['timeout']);
        $session_->open();
        $attempt_ = $session_->get('countOfAttempts', 0) + 1;
        if ($attempt_ >= $restricts['numberOfAttempts']) {
            if ($session_->get('restrictTime', 0) === 0) {
                $session_->add('restrictTime', time());
                return TRUE;
            } elseif ((time()-$session_->get('restrictTime', 0)) >= $restricts['timeout']) {
                $session_->remove('restrictTime');
                $session_->add('countOfAttempts', 1);
                $session_->close();
                return FALSE;
            } else {
                $session_->close();
                return TRUE;
            }
        } else {
            $session_->add('countOfAttempts', $attempt_);
            $session_->close();
            return FALSE;
        }
    }
}
?>
<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>