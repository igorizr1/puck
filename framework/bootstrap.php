<?php

require_once "response/ApiProblem.php";
require_once "response/JsonResponse.php";

require_once "rest/RestResource.php";

require_once "core/ComponentManager.php";
require_once "core/PuckComponent.php";
require_once "core/ConfigManager.php";
require_once "core/ModuleManager.php";

require_once "router/ResourceInitializer.php";
require_once "router/RouteManager.php";
require_once "router/Router.php";

require_once "core/Puck.php";

$app = new \Puck\Core\Puck();
$app->run();