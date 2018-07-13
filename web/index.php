<?php

use dimichspb\messagebird\WebApplication;

require_once (dirname(__DIR__) . '/src/bootstrap.php');

$configFilePath = dirname(__DIR__);
$configFileName = 'config.ini';
$localConfigFileName = 'config-local.ini';

$application = createApplication(
    WebApplication::class,
    $configFilePath,
    $configFileName,
    $localConfigFileName
);

$application->run();
