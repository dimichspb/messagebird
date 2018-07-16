<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\commands\DefaultCommand;
use dimichspb\messagebird\middlewares\router\Route;
use dimichspb\messagebird\requests\ConsoleRequest;
use dimichspb\messagebird\responses\ConsoleResponse;

/**
 * Class ConsoleApplication
 * @package dimichspb\messagebird
 */
class ConsoleApplication extends BaseApplication
{
    /**
     * @return ConsoleRequest|requests\RequestInterface
     */
    public function getRequest()
    {
        return new ConsoleRequest();
    }

    /**
     * @return ConsoleResponse|responses\ResponseInterface
     */
    public function getResponse()
    {
        return new ConsoleResponse();
    }

    /**
     * @return Route
     */
    public function getDefaultRoute()
    {
        return new Route(Route::DEFAULT_ROUTE_ALIAS, DefaultCommand::class);
    }


}