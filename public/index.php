<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 30.04.15
 * Time: 14:09
 */


require __DIR__ . "/../framework/bootstrap.php";
require __DIR__ . "/../module/profile/ProfileResource.php";

use Example\Profile\ProfileResource;

$pr = new ProfileResource();
$pr->create();