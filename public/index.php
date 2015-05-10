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

require __DIR__ . "/../framework/bootstrap.php";