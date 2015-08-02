<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 13.05.15
 * Time: 17:37
 */

namespace Bonny\Core;

use Bonny\Helpers\Singleton;

class Autoloader extends Singleton{

    private $namespaces = array();

    public function addConfig($config){

        $this->namespaces = array_merge($this->namespaces, $config);
        return TRUE;
    }

    public function __autoload($class){
        require_once $this->namespaces[$class];
    }

    protected function __construct(){
        spl_autoload_register(array($this, '__autoload'), true);
    }


} 