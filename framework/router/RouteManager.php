<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:43
 */

namespace Puck\Router;

use Puck\Core\PuckComponent;

class RouteManager extends PuckComponent{
    private $routes;

    private static function parseRoute($url){
        $regExp = "/^";
        $parts = explode("/", $url);
        $params = array();
        $routeType = FALSE;

        foreach($parts as $part){
            if($part !== ""){
                if(preg_match('/^:(.+)/', $part, $matchParams)){
                    //route param
                    $regExp .= '\/(.+)';
                    array_shift($matchParams);
                    $params = array_merge($params, $matchParams);
                    $routeType = "resource";
                }else{
                    //route part
                    $regExp .= '\/'.$part;
                    $routeType = "collection";
                }
            }
        }
        $regExp .= "$/";
        return array(
            "regExp"    =>  $regExp,
            "params"    =>  $params,
            "routeType" =>  $routeType
        );
    }

    private function addRoute($url, $routeConfig){
        $parsedConfig = array_merge($routeConfig, self::parseRoute($url));
        return $this->routes[$parsedConfig['regExp']] = $parsedConfig;
    }

    private function get_from_config(){
        $routes = $this->getComponent("ConfigManager")->getRouteConfig();
        foreach($routes as $url => $routeConfig){
            $this->addRoute($url, $routeConfig);
        }
    }

    public function get_routes(){
        if(!$this->routes)
            $this->get_from_config();
        return $this->routes;
    }
}