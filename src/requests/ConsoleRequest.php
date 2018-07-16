<?php
namespace dimichspb\messagebird\requests;

/**
 * Class ConsoleRequest
 * @package dimichspb\messagebird\requests
 */
class ConsoleRequest implements RequestInterface
{
    /**
     * @return null
     */
    public function getAlias()
    {
        global $argv;

        $param = isset($argv[1])? $argv[1]: null;

        return $param;
    }

    /**
     * @return null
     */
    public function getMethod()
    {
        return null;
    }

    /**
     * @return bool|string
     */
    public function getBody()
    {
        return file_get_contents('php://input');
    }
}