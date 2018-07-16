<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\controllers\DefaultController;
use dimichspb\messagebird\middlewares\router\Route;
use dimichspb\messagebird\requests\HttpRequest;
use dimichspb\messagebird\responses\HttpResponse;

/**
 * Class WebApplication
 * @package dimichspb\messagebird
 */
class WebApplication extends BaseApplication
{
    /**
     * @return HttpRequest|requests\RequestInterface
     */
    public function getRequest()
    {
        return new HttpRequest();
    }

    /**
     * @return HttpResponse|responses\ResponseInterface
     */
    public function getResponse()
    {
        return new HttpResponse();
    }

    /**
     * @return Route
     */
    public function getDefaultRoute()
    {
        return new Route(Route::DEFAULT_ROUTE_ALIAS, DefaultController::class);
    }


}