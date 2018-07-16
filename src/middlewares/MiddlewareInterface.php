<?php
namespace dimichspb\messagebird\middlewares;


use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

/**
 * Interface MiddlewareInterface
 * @package dimichspb\messagebird\middlewares
 */
interface MiddlewareInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function process(RequestInterface $request, ResponseInterface $response);
}