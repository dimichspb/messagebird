<?php
namespace dimichspb\messagebird\responses;

interface ResponseInterface
{
    public function setBody($body);
    public function getBody();
    public function writeLine($line);
}