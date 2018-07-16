<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\commands\DefaultCommand;
use dimichspb\messagebird\middlewares\router\Route;
use dimichspb\messagebird\requests\ConsoleRequest;
use dimichspb\messagebird\responses\ConsoleResponse;

class ConsoleApplication extends BaseApplication
{
    public function getRequest()
    {
        return new ConsoleRequest();
    }

    public function getResponse()
    {
        return new ConsoleResponse();
    }

    public function getDefaultRoute()
    {
        return new Route(Route::DEFAULT_ROUTE_ALIAS, DefaultCommand::class);
    }


}