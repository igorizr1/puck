<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 02.08.15
 * Time: 10:51
 */

namespace Bonny\Core;

use Bonny\Helpers\Singleton;
use Bonny\Router\Router;

final class Bonny extends Singleton{

    /**
     * initialize
     */
    protected function __construct(){
        $router = Router::getInstance();
        $router->findRoute();
    }
}