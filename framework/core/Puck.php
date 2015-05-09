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

        $cm->register("RouteManager", new RouteManager($cm));
        $cm->register("ServiceManager", new ServiceManager($cm));

        $cm->register("ConfigManager", new ConfigManager($cm));
        $cm->register("ModuleManager", new ModuleManager($cm));
        $cm->register("Router", new Router($cm));

        $this->findRouteMatch();
    }

    private function findRouteMatch(){
        $router = $this->ComponentManager->get("Router");
        $router->findRoute();
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
            $module_file = require_once __DIR__."/../../module/{$module_name}/src/Module.php";
            $module_namespace = "\\{$module_name}\\Module";
            $module = new $module_namespace;

            $this->modules[$module_name] = $module;

            $routeManager->addModuleRoutes($module->getRouteConfig($this->getComponent("ServiceManager")));

        }

//        print_r('$this->modules');
//        print_r($this->modules);
    }
}

class PuckModule extends PuckComponent {

}

class ServiceManager extends PuckModule {

}

class RouteManager extends PuckComponent{
    private $routes = array();

    private function parseRoute($url){
        $regExp = "/";
        $parts = explode("/", $url);
        $params = array();

        foreach($parts as $part){
            if($part !== ""){
                if(preg_match('/^:(.+)/', $part, $matchParams)){
                    //route param
                    $regExp .= '\/(.+)';
                    array_shift($matchParams);
                    $params = array_merge($params, $matchParams);
                }else{
                    //route part
                    $regExp .= '\/'.$part;
                }
            }
        }
        $regExp .= "/";
        return array(
            "regExp" =>  $regExp,
            "params" =>  $params,
        );
    }

    private function addRoute($url, $routeConfig){
        $parsedConfig = array_merge($routeConfig, $this->parseRoute($url));
        $this->routes[$parsedConfig['regExp']] = $parsedConfig;
    }

    public function addModuleRoutes($routes){
        foreach($routes as $url => $routeConfig){
            $this->addRoute($url, $routeConfig);
        }
    }

    public function get_routes(){
        return $this->routes;
    }
}

class Router extends PuckComponent{

    public function findRoute(){
        $route = $_SERVER['REQUEST_URI'];
        print_r("REQUEST_URI\n");
        print_r($_SERVER['REQUEST_URI']);
//        $_SERVER['REQUEST_METHOD'];
        $all_routes = $this->getComponent("RouteManager")->get_routes();

        foreach($all_routes as $regExp => $routeConfig){
            if(preg_match($regExp, $route, $matchParams)){

                array_shift($matchParams);

                print_r("\n".'$regExp'."\n");
                print_r($regExp."\n");
                print_r('$route'."\n");
                print_r($route."\n");
                print_r('$matchParams'."\n");
                print_r($matchParams);
                print_r("\n".'$routeConfig'."\n");
                print_r($routeConfig);
            }
        }

//        print_r("\nall_routes_pattern\n");
////        print_r($all_routes_pattern);
//        print_r("\nroute match result\n");

//        print_r(preg_match('/'.$all_routes_pattern.'/', $route, $matches));

//        print_r($matches);

    }

}