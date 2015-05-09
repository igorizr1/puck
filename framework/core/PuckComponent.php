<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:48
 */

namespace Puck\Core;


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