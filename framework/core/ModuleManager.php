<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:50
 */

namespace Puck\Core;


class ModuleManager extends PuckComponent{
    private $modules = array();

    public function __construct($cm){
        parent::__construct($cm);
        $this->includeModules();
    }

    private function includeModules(){
        /**
         * ForEach module create instance PuckModule
         * and save it in modules variable
         */
        $routeManager = $this->getComponent("RouteManager");

        foreach($this->getComponent("ConfigManager")->getModuleListConfig() as $module_name){
            $module_file = require_once APPLICATION_PATH."/module/{$module_name}/src/Module.php";
            $module_namespace = "\\{$module_name}\\Module";
            $module = new $module_namespace;

            $this->modules[$module_name] = $module;

            $routeManager->addModuleRoutes($module->getRouteConfig($this->getComponent("ServiceManager")));
        }
        return $this->modules;
    }
}