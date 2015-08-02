<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 12.05.15
 * Time: 16:22
 */

namespace Invoice;


use Puck\Modules\ServiceManager;
use Puck\Modules\ServiceInterface;

class InvoiceService implements ServiceInterface{

    protected $serviceManager;

    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

}