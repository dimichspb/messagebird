<?php
namespace dimichspb\messagebird\responses;

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
}