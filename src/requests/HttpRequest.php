<?php
namespace dimichspb\messagebird\requests;

use dimichspb\messagebird\exceptions\MethodNotAllowedException;
use dimichspb\messagebird\helpers\UrlHelper;
use dimichspb\messagebird\requests\methods\GetMethod;
use dimichspb\messagebird\requests\methods\PostMethod;

class HttpRequest implements RequestInterface
{
    public function getAlias()
    {
        $param = $_SERVER['REQUEST_URI'];
        $param = UrlHelper::parseUrl($param);

        $param = $param? $param: null;

        return $param;
    }

    public function getMethod()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                return GetMethod::class;
            case 'POST':
                return PostMethod::class;
            default:
                return null;
        }
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}