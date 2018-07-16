<?php
namespace dimichspb\messagebird\requests;

class ConsoleRequest implements RequestInterface
{
    public function getAlias()
    {
        global $argv;

        $param = isset($argv[1])? $argv[1]: null;

        return $param;
    }

    public function getMethod()
    {
        return null;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}