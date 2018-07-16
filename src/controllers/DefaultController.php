<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\requests\methods\GetMethod;

/**
 * Class DefaultController
 * @package dimichspb\messagebird\controllers
 */
class DefaultController extends BaseController
{
    /**
     * @return bool|string
     */
    public function run()
    {
        return $this->render('index');
    }

    /**
     * @return array|mixed
     */
    public function allowedMethods()
    {
        return [
            GetMethod::class
        ];
    }
}