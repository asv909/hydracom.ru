<?php
/**
 * Description of ServiceModule
 *
 * @author asv
 */
class ServiceModule extends CWebModule 
{
    public $restrictAuthenticate = array(
        'officeIP' => '127.0.0.1',
        'numberOfAttempts' => 3,
        'timeout' => 30,
        );
    
    public function init() 
    {
        $this->setImport(array(
            'service.models.*',
            'service.components.*',
            ));
    } 
}
?>