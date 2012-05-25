<?php

/**
 * Description of Helpers
 *
 * @author asv
 */
class Helpers {
    //
    static function encrypt($text){
        return sha1($text);
    }
    //
    static function createUrl($url){
        return Yii::app()->params->SeleniumTestsEnvironment . $url;
    }
}