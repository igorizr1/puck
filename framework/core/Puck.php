<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 11:52
 */

namespace Puck\Core;

class Puck {
    private $ComponentManager;

    public function run(){
//        print_r($_SERVER);
        $cm = new ComponentManager();
        $this->ComponentManager = $cm;

        $cm->register("ConfigManager", new ConfigManager($cm));
        $cm->register("ModuleManager", new ModuleManager($cm));
        $cm->register("Router", new Router($cm));
    }

}

/**
 * Class PuckComponent
 * @package Puck\Core
 *
 * Base Component Class
 * Should be Singleton
 */
class PuckComponent {
    private $cm;

    public function __construct($cm){
        $this->cm = $cm;
    }

    private function getComponentManager(){
        return $this->cm;
    }

    public function getComponent($name){
        return $this->getComponentManager()->get($name);
    }
}

class ComponentManager{
    private $components = array();

    public function register($name, $instance){
        return $this->components[$name] = $instance;
    }

    public function get($name){
        return $this->components[$name];
    }

}

class ConfigManager extends PuckComponent{
    private $configs = array();

    public function __construct($cm){
        parent::__construct($cm);
        $this->includeConfigs();
    }

    private function includeConfigs(){
        $this->configs = require __DIR__."/../../config/development.config.php";
    }

    public function getModuleListConfig(){
        return $this->configs['modules'];
    }

}

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

        $this->modules = array();

        $routeManager = $this->getComponent("RouteManager");

        foreach($this->getComponent("ConfigManager")->getModuleListConfig() as $module_name){
            $module_file = require_once __DIR__."/../../module/{$module_name}.php";
            $module = new $module_file."\\Module";

            $this->modules[$module_name] = $module;

            $routeManager->addModuleRoutes($module->getRouteConfig());

        }

        print_r('$this->modules');
        print_r($this->modules);
    }
}

class PuckModule extends PuckComponent {

}

class RouteManager extends PuckComponent{
    private $routes = array();

    private function parseRoute($routeConfig){
        return $routeConfig;
    }

    private function addRoute($routeConfig){
        array_push($this->routes, $this->parseRoute($routeConfig));
    }

    public function addModuleRoutes($routeConfig){
        foreach($routeConfig as $route){
            $this->addRoute($route);
        }
    }
}

class Router extends PuckComponent{

    public function findRoute(){
        $_SERVER['REQUEST_URI'];
        $_SERVER['REQUEST_METHOD'];
    }

}