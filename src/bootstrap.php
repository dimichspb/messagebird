<?php

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\WebApplication;

require_once (dirname(__DIR__) . '/vendor/autoload.php');

function createApplication($applicationClass, $configPath, $configFileName, $localConfigFileName) {
    if (!is_string($applicationClass)) {
        throw new InvalidArgumentException('Application class must be a string');
    }
    if (!class_exists($applicationClass)) {
        throw new InvalidArgumentException('Application class does not exist');
    }

    $configurator = new Configurator($configPath, $configFileName, $localConfigFileName);
    $clientAdapter = new MessageBirdClientAdapter();
    $clientAdapter->setAccessKey(new AccessKey($configurator->get('messagebird.access_key')));

    $application = new WebApplication($clientAdapter);

    if (!$application instanceof \dimichspb\messagebird\BaseApplication) {
        throw new InvalidArgumentException('Application class must extend \dimichspb\messagebird\BaseApplication class');
    }

    return $application;
}