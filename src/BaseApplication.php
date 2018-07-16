<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\middlewares\MiddlewareInterface;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

/**
 * Class BaseApplication
 * @package dimichspb\messagebird
 */
abstract class BaseApplication
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    /**
     * BaseApplication constructor.
     * @param array $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        AssertHelper::isAllInstanceOf($middlewares, MiddlewareInterface::class);
        $this->middlewares = $middlewares;
    }

    /**
     * @param MiddlewareInterface $middleware
     */
    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @param MiddlewareInterface $middleware
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    protected function processMiddleware(MiddlewareInterface $middleware, RequestInterface $request, ResponseInterface $response)
    {
        $middleware->process($request, $response);
    }

    /**
     *
     */
    public function run()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        try {
            foreach ($this->middlewares as $middleware) {
                $this->processMiddleware($middleware, $request, $response);
            }
        } catch (\Exception $exception) {
            $response->setBody($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        }

        echo $response->getBody();
    }

    /**
     * @return RequestInterface
     */
    abstract public function getRequest();

    /**
     * @return ResponseInterface
     */
    abstract public function getResponse();
}