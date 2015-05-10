<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:48
 */

namespace Puck\Core;

use Puck\Helpers\Singleton;

final class ComponentManager extends Singleton{
    private $components = array();

    public function register($name, $instance){

//        echo $instance::getClassName();/

        return $this->components[$name] = $instance;
    }

    public function get($name){
        return $this->components[$name];
    }

}