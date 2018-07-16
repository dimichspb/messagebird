<?php
namespace dimichspb\messagebird\responses;

/**
 * Class ConsoleResponse
 * @package dimichspb\messagebird\responses
 */
class ConsoleResponse implements ResponseInterface
{
    /**
     * @var
     */
    protected $body;

    /**
     * @param $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $line
     */
    public function writeLine($line)
    {
        echo $line . PHP_EOL;
    }
}