<?php
/**
 * Description of ServiceModule
 *
 * @author asv
 */
class ServiceModule extends CWebModule 
{
    public $restrict_authen = array(
        'office_IP' => '127.0.0.1',
        'num_of_attempts' => 3,
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