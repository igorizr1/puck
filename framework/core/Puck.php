<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 11:52
 */

namespace Puck\Core;

use Puck\Helpers\Singleton;
use Puck\Router\RouteManager;
use Puck\Router\Router;
use Puck\Modules\ServiceManager;

final class Puck extends Singleton{

    /**
     * initialize
     */
    protected function init(){
        $cm = ComponentManager::getInstance();
        $cm->register("ConfigManager", ConfigManager::getInstance($cm));
        $cm->register("RouteManager", RouteManager::getInstance($cm));
        $cm->register("ServiceManager", ServiceManager::getInstance($cm));
        $cm->register("ModuleManager", ModuleManager::getInstance($cm));
//
        $router = Router::getInstance($cm);
        $router->findRoute();
        $cm->register("Router", $router);
    }
}