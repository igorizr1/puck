<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:49
 */

namespace Puck\Core;


class ConfigManager extends PuckComponent{
    private $configs = array(
        "modules"  =>  FALSE,
        "routes"   =>  FALSE,
    );

    protected function init(ComponentManager $cm){
        parent::init($cm);
        $this->includeAppConfigs();
    }

    private function merge_config($config){
        $this->configs = array_merge($this->configs, $config);
    }

    private function includeAppConfigs(){
        $development_config = require_once APPLICATION_PATH."/config/development.config.php";
        $this->merge_config($development_config);
    }

    public function addModuleConfig($config){
        $this->merge_config($config);
    }

    public function getModuleListConfig(){
        return $this->configs['modules'];
    }

    public function getRouteConfig(){
        return $this->configs['routes'];
    }

}