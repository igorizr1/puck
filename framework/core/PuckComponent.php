<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 09.05.15
 * Time: 17:48
 */

namespace Puck\Core;

use Puck\Helpers\SingletonCM;


/**
 * Class PuckComponent
 * @package Puck\Core
 *
 * Base Component Class
 * Should be Singleton
 */

class PuckComponent extends SingletonCM{
    private $cm;

    protected function getComponent($name){
        return $this->cm->get($name);
    }

    protected function init(ComponentManager $cm){
        if(!$this->cm)
            $this->cm = $cm;
        return $this;
    }
}