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
}