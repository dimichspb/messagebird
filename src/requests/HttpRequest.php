<?php
namespace dimichspb\messagebird\requests;


use dimichspb\messagebird\helpers\UrlHelper;
use dimichspb\messagebird\requests\methods\GetMethod;
use dimichspb\messagebird\requests\methods\PostMethod;

/**
 * Class HttpRequest
 * @package dimichspb\messagebird\requests
 */
class HttpRequest implements RequestInterface
{
    /**
     * @return null|string
     */
    public function getAlias()
    {
        $param = $_SERVER['REQUEST_URI'];
        $param = UrlHelper::parseUrl($param);

        $param = $param? $param: null;

        return $param;
    }

    /**
     * @return null|string
     */
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

    /**
     * @return bool|string
     */
    public function getBody()
    {
        return file_get_contents('php://input');
    }
}