<?php
namespace dimichspb\messagebird\responses;

use dimichspb\messagebird\exceptions\NotSupportedException;

/**
 * Class HttpResponse
 * @package dimichspb\messagebird\responses
 */
class HttpResponse implements ResponseInterface
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
        throw new NotSupportedException('Method not supported');
    }
}