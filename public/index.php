<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 14:09
 */

error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);

if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
}

$app = require __DIR__ . "/../bonny/bootstrap.php";

use Bonny\Core\Autoloader;



Autoloader::getInstance()->addConfig(
    require __DIR__.'/../config/autoloader.config.php'
);

$modules = require __DIR__.'/../config/modules.config.php';

foreach($modules as $module){
    $name = "{$module}\\Route";

    $name::getInstance();
}

return $app = \Bonny\Core\Bonny::getInstance();