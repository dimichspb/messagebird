<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\controllers\DefaultController;
use dimichspb\messagebird\requests\HttpRequest;
use dimichspb\messagebird\responses\HttpResponse;

class WebApplication extends BaseApplication
{
    public function getRequest()
    {
        return new HttpRequest();
    }

    public function getResponse()
    {
        return new HttpResponse();
    }

    public function getDefaultRoute()
    {
        return new Route('default', DefaultController::class);
    }


}