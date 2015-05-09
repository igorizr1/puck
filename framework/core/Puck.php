<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 11:52
 */

namespace Puck\Core;

use Puck\Router\RouteManager;
use Puck\Router\Router;

class Puck {
    private $ComponentManager;

    public function run(){
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

class PuckModule extends PuckComponent {

}

class ServiceManager extends PuckModule {

}