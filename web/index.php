<?php

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\controllers\DefaultController;

use dimichspb\messagebird\WebApplication;
use dimichspb\messagebird\processors\configuration\File;
use dimichspb\messagebird\processors\configuration\IniFileProcessor;
use dimichspb\messagebird\middlewares\router\Router;

require_once (__DIR__ . '/../src/bootstrap.php');

$configPath = dirname(__DIR__);
$configFileName = 'config.ini';
$localConfigFileName = 'config-local.ini';

$configurator = new Configurator(new IniFileProcessor([
    new File($configPath, $configFileName),
    new File($configPath, $localConfigFileName)
]));

$router = new Router($configurator, 'web.routes');
$router->setDefaultRoute(DefaultController::class);
$application = new WebApplication();
$application->addMiddleware($router);

$application->run();
