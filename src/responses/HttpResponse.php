<?php
namespace dimichspb\messagebird\responses;

use dimichspb\messagebird\exceptions\NotSupportedException;

class HttpResponse implements ResponseInterface
{
    protected $body;

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function writeLine($line)
    {
        throw new NotSupportedException('Method not supported');
    }
}