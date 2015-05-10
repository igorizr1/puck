<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:40
 */

namespace Puck\Router;

use Puck\Core\PuckComponent;
use Puck\Response\ApiProblem;
use Puck\Core\ComponentManager;

class Router extends PuckComponent{

    private $REQUEST_URI;
    private $REQUEST_METHOD;

    private static $method_actions = array(
        "resource"    =>  array(
            "GET"       =>  "fetch",
            "PUT"       =>  "update",
            "DELETE"    =>  "delete",
            //patch
        ),
        "collection"    =>  array(
            "POST"      =>  "create",
            "GET"       =>  "fetchAll",
            "PUT"       =>  "replaceList",
            "DELETE"    =>  "deleteList",
        ),
    );

    protected function init(ComponentManager $cm){
        parent::init($cm);
        $this->REQUEST_URI = $_SERVER['REQUEST_URI'];
        $this->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    }

    public function findRoute(){
        foreach($this->getComponent("RouteManager")->get_routes() as $regExp => $routeConfig){
            if(preg_match($regExp, $this->REQUEST_URI, $matchParams)){
                if($methodConfig = $routeConfig['methods'][$this->REQUEST_METHOD]){
                    if($resourceAction = $this->getResourceAction($routeConfig['routeType'])){
                        array_shift($matchParams);
                        $resourceParams = array(
                            "uri_params"    =>  $this->matchParams($routeConfig['params'], $matchParams),
                            "query_params"  =>  array(),
                            "body_params"  =>  array()
                        );
                        // ROUTE FOUND
                        return $this->callResource($routeConfig['resource'], $resourceAction, $resourceParams, $methodConfig);
                    }
                }
                // error: method not allowed
                return new ApiProblem(405);
            }
        }
        // error: Route not Found
        return new ApiProblem(404);
    }

    private function getResourceAction($routeType){
        if(array_key_exists($routeType, self::$method_actions) && array_key_exists($this->REQUEST_METHOD, self::$method_actions[$routeType])){
            return self::$method_actions[$routeType][$this->REQUEST_METHOD];
        }
        return FALSE;
    }

    private function matchParams($keys, $values){
        return array_combine($keys, $values);
    }

    private function callResource($resource, $action, $params, $config){
        if($this->checkConfig($config)){
            //will be true if all checks are ok
            return new ResourceInitializer($resource, $action, $params);
        }
        return FALSE;
    }

    private function checkConfig($config){
        if($this->checkAuth($config)){
            if($this->checkValidation($config)){
                return $this->checkAcl($config);
            }
        }
        return FALSE;
    }

    private function checkAuth($config){
        if(in_array("auth_required", $config)){

        }
        return TRUE;
    }

    private function checkValidation($config){
        if(in_array("validator", $config)){

        }
        return TRUE;
    }

    private function checkAcl($config){
        if(in_array("acl", $config)){

        }
        return TRUE;
    }

}