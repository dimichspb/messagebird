<?php
namespace dimichspb\messagebird\requests;

interface RequestInterface
{
    public function getAlias();

    public function getMethod();

    public function getBody();
}