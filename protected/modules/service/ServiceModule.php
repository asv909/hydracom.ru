<?php
/**
 * Description of ServiceModule
 *
 * @author asv
 */
class ServiceModule extends CWebModule 
{
    public function init() 
    {
        $this->setImport(array(
            'service.models.*',
            'service.components.*',
            ));
    } 
}