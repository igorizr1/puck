<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:49
 */

namespace Puck\Core;


class ConfigManager extends PuckComponent{
    private $configs = array();

    public function __construct($cm){
        parent::__construct($cm);
        $this->includeConfigs();
    }

    private function includeConfigs(){
        $this->configs = require APPLICATION_PATH."/config/development.config.php";
    }

    public function getModuleListConfig(){
        return $this->configs['modules'];
    }

}