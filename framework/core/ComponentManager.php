<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:48
 */

namespace Puck\Core;


class ComponentManager{
    private $components = array();

    public function register($name, $instance){
        return $this->components[$name] = $instance;
    }

    public function get($name){
        return $this->components[$name];
    }

}