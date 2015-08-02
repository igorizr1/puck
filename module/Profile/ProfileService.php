<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 12.05.15
 * Time: 16:15
 */

namespace League\Profile;

use Puck\Modules\ServiceManager;
use Puck\Modules\ServiceInterface;

class ProfileService implements ServiceInterface{

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