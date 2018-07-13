<?php
namespace dimichspb\messagebird\middlewares;


use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

interface MiddlewareInterface
{
    public function process(RequestInterface $request, ResponseInterface $response);
}