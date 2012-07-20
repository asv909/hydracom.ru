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


    /**
     * Index action gives to browser main page for service module, but if is Guest 
     * then redirect to login page
     */
    public function actionIndex()
    {
        $this->Session('start');
        if ((!Yii::app()->user->isGuest) && ($this->checkSecutityKey())) {
            $this->redirect(Yii::app()->user->returnUrl = 'service');
        }
        $this->Session('stop');
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl = 'login');
    }

    <!--        <ul>
            <li>Справочники для номенклатуры
                <ul>
                    <li><a href='/service/admin/look/id/brand'>Бренды</a></li>
                    <li><a href='/service/admin/look/id/country'>Страны</a></li>
                    <li><a href='/service/admin/look/id/measure'>Единицы измерения</a></li>
                </ul>
            </li>
            <li>Справочники для контрагентов
                <ul>
                    <li><a href='/service/admin/look/id/post'>Индексы</a></li>
                    <li><a href='/service/admin/look/id/region'>Регионы</a></li>
                    <li><a href='/service/admin/look/id/city'>Города</a></li>
                    <li><a href='/service/admin/look/id/org'>ОПФ</a></li>
                </ul>
            </li>
        </ul>
-->