<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\requests\methods\GetMethod;

class DefaultController extends BaseController
{
    public function run()
    {
        return $this->render('index');
    }

    public function allowedMethods()
    {
        return [
            GetMethod::class
        ];
    }
}